@extends('application.template')

@section('content')
    <div class="container">
        @include('application.common.message')
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Exportar</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Nascimento</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Cidade/UF</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <th class="text-center"><input type="checkbox" name="exportData" /></th>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ date('d/m/Y', strtotime($client->birth)) }}</td>
                        <td>{{ $client->adresses[0]->zipcode }}</td>
                        <td>{{ $client->adresses[0]->city.'/'.$client->adresses[0]->state }}</td>
                    </tr>                    
                @endforeach
            </tbody>
        </table>
        <a href="{{ url('/clientes/create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Cadastrar Cliente</a>
        <button id="exportCsv" class="btn btn-warning"><i class="fas fa-file-csv"></i> Importar CSV</button>
    </div>
@endsection