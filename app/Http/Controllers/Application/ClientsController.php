<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Clients;
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

        $client = $address = null;

        if(!$request->hasFile('csvArchive') || !$request->file('csvArchive')->isValid() || $request->csvArchive->getClientOriginalExtension() !== 'csv'){
            return back()->withInput()->with([ 'success' => false, 'message' => 'Nenhum arquivo válido foi enviado.' ]);
        }

        try {

            Excel::import(new ClientsImport, $request->file('csvArchive'), \Maatwebsite\Excel\Excel::CSV);

            return redirect('/clientes')->with([ 'success', true, 'message' => 'Cadastro efetuado com sucesso' ]);

        } catch (\Throwable $th) {
            if($client !== null) $client->delete();
            if($address !== null) $address->delete();
            return back()->withInput()->with([ 'success' => false, 'message' => 'Ops, ocorreu um erro: '.$th->getMessage() ]);
        }
        
    }
}
