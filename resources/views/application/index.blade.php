@extends('application.template')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <div class="card-box box_gray">
                    <i class="fas fa-user-plus"></i>
                    <p>
                        Clientes<br/>
                        <a href="{{ url('clientes/create') }}">Cadastrar</a>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-box box_blue">
                    <i class="fas fa-users"></i>
                    <p>
                        Cadastros<br/>
                        <a href="{{ url('clientes') }}">Ver todos</a>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-box box_gray">
                    <i class="fas fa-truck-loading"></i>
                    <p>
                        Rotas<br/>
                        <a href="{{ url('rotas') }}">Ver todos</a>
                    </p>
                </div>
            </div>

        </div>
    </div>

@endsection