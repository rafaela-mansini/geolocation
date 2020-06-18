<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Clients;
use App\Models\Adresses;
use App\Models\Utils\GoogleApi;
use App\Imports\ClientsImport;
use Maatwebsite\Excel\Facades\Excel;

class ClientsController extends Controller
{
    public function index(){
        $clients = Clients::with('adresses')->paginate(20);
        // dd($clients);
        return view('application.clients.index', compact('clients'));
    }
    public function create(){
        return view('application.clients.create');
    }
    public function store(Request $request){
        $client = $address = null;
        try {

            $addressGeolocation = GoogleApi::addresGeolocation($request->all());
            $geolocation = GoogleApi::getGeocode($addressGeolocation);

            $request->request->add([
                'lat' => $geolocation[0]['geometry']['location']['lat'],
                'lng' => $geolocation[0]['geometry']['location']['lng'],
            ]);

            $client = Clients::create($request->all());
            $address = $client->adresses()->create($request->all());
            return redirect('/clientes')->with([ 'success', true, 'message' => 'Cadastro efetuado com sucesso' ]);

        } catch (\Throwable $th) {
            if($client !== null) $client->delete();
            if($address !== null) $address->delete();
            return back()->withInput()->with([ 'success' => false, 'message' => 'Ops, ocorreu um erro: '.$th->getMessage() ]);
        }
    }

    public function storeCsv(Request $request){

        if(!$request->hasFile('csvArchive') || !$request->file('csvArchive')->isValid() || $request->csvArchive->getClientOriginalExtension() !== 'csv'){
            return back()->withInput()->with([ 'success' => false, 'message' => 'Nenhum arquivo válido foi enviado.' ]);
        }

        try {

            Excel::import(new ClientsImport, $request->file('csvArchive'), \Maatwebsite\Excel\Excel::CSV);
            return redirect('/clientes')->with([ 'success', true, 'message' => 'Cadastro efetuado com sucesso' ]);

        } catch (\Throwable $th) {
            return back()->withInput()->with([ 'success' => false, 'message' => 'Ops, ocorreu um erro: '.$th->getMessage() ]);
        }
        
    }

    public function route(Request $request){

        

        $bestRoute = array();

        foreach ($request->exportData as $id) {
            $address = Adresses::find($id);
            $route = GoogleApi::distance($address->lat, $address->lng);

            $bestRoute[] = ['address' => $address, 'distance' => $route['value'], 'textDistance' => $route['text']];
        }
        array_multisort(array_column($bestRoute, "distance"), SORT_ASC, $bestRoute);
        return response()->json($bestRoute);
    }

}
