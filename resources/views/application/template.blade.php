<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('application/images/favicon.png') }}" type="image/x-icon">
        <title>{{ env('APP_NAME') }}</title>

        <link rel="stylesheet" href="{{ asset('application/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('application/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('application/css/style.css') }}">
        @stack('css')
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-principal">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('application/images/logo.png') }}" width="30" height="30" alt="{{ env('APP_NAME') }}" loading="lazy">
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('clientes') }}">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('rotas') }}">Rotas</a>
                </li>
            </ul>
        </div>
    </nav>

    @yield('content')

    <script src="{{ asset('application/js/jquery.min.js') }}"></script>
    <script src="{{ asset('application/js/bootstrap.min.js') }}"></script>
    @stack('js')
    </body>
</html>
