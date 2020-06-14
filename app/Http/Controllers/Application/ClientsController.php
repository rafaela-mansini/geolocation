<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Clients;

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
}
