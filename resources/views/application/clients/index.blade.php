@extends('application.template')

@section('content')
    <div class="container">
        @include('application.common.message')
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Selecionar para <br/>Gerar rota</th>
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
                        <th class="text-center"><input type="checkbox" name="exportData[]" id="exportData" form="exportForm" value="{{ $client->adresses[0]->id }}" /></th>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ date('d/m/Y', strtotime($client->birth)) }}</td>
                        <td>{{ $client->adresses[0]->zipcode }}</td>
                        <td>{{ $client->adresses[0]->city.'/'.$client->adresses[0]->state }}</td>
                    </tr>                    
                @endforeach
            </tbody>
        </table>
        <form name="exportForm" id="exportForm">@csrf</form>
        <a href="{{ url('/clientes/create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Cadastrar Cliente</a>
        <button data-toggle="modal" data-target="#modalCsv" class="btn btn-warning"><i class="fas fa-file-csv"></i> Importar CSV</button>
        <button id="gerarRota" class="btn btn-danger"><i class="fas fa-truck"></i> Gerar rota</button>

        @include('application.clients.csvForm')
        @include('application.clients.route')
    </div>

    @push('js')
        <script>
            $("#gerarRota").click(() => {
                $.ajax({
                    url: '/clientes/rota',
                    type: 'POST',
                    dataType: 'json', 
                    data: $("#exportForm").serialize()
                })
                .done(response => {
                    let bodyResponse = '';

                    $.each(response, function(index, value){
                        bodyResponse += '<tr>';
                        bodyResponse += '<td>' + value.address.zipcode + '</td>';
                        bodyResponse += '<td>' + value.address.street + '</td>';
                        bodyResponse += '<td>' + value.address.city + '/' + value.address.uf + '</td>';
                        bodyResponse += '<td>' + value.textDistance + '</td>';
                        bodyResponse += '</tr>';
                    });
                    console.log(bodyResponse);
                    $("#bodyRoute").html(bodyResponse);
                    $("#gerarRotaModal").modal('show');
                });
            });
        </script>
    @endpush
@endsection