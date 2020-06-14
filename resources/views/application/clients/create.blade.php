@extends('application.template')

@section('content')
    <div class="container">
        @include('application.common.message')
        <form action="{{ url('/clientes') }}" method="POST" >
        @csrf
            <fieldset>
                <div class="row">
                    <legend>Dados pessoais</legend>
                    <div class="col-md-8 form-group">
                        <label for="name">Digite seu nome</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" />
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="birth">Nascimento</label>
                        <input class="form-control" type="date" name="birth" id="birth" value="{{ old('birth') }}" />
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="email">E-mail</label>
                        <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" />
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="row">
                    <legend>Endereço</legend>
                    <div class="col-md-4 form-group">
                        <label for="zipcode">CEP</label>
                        <input class="form-control zipcode" type="text" name="zipcode" id="zipcode" value="{{ old('zipcode') }}" />
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="street">Logradouro</label>
                        <input class="form-control" type="text" name="street" id="street" value="{{ old('street') }}" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="number">Número</label>
                        <input class="form-control" type="text" name="number" id="number" value="{{ old('number') }}" />
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="complement">Complemento</label>
                        <input class="form-control" type="text" name="complement" id="complement" value="{{ old('complement') }}" />
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="neighborhood">Bairro</label>
                        <input class="form-control" type="text" name="neighborhood" id="neighborhood" value="{{ old('neighborhood') }}" />
                    </div>
                    <div class="col-md-5 form-group">
                        <label for="city">Cidade</label>
                        <input class="form-control" type="text" name="city" id="city" value="{{ old('city') }}" />
                    </div>
                    <div class="col-md-1 form-group">
                        <label for="state">UF</label>
                        <input class="form-control" type="text" name="state" id="state" value="{{ old('state') }}" />
                    </div>
                </div>
            <fieldset>
            <button class="btn btn-primary">Salvar</button>
        </form>
    </div>

    @push('js')
    <script src="{{ asset('application/js/jquery.mask.js') }}"></script>
    <script>
        $(document).ready(() => {
            $('.zipcode').mask('00000-000');
        })
        $("#zipcode").blur(() => {
            
            let zipcode = $('#zipcode').val().replace('-', '');
            $.ajax({
                url: 'https://viacep.com.br/ws/' + zipcode + '/json/',
                dataType: 'jsonp',
                beforeSend: () => {
                    $("#street").val('...');
                    $("#neighborhood").val('...');
                    $("#city").val('...');
                    $("#state").val('...');
                }
            }).done(response => {
                if(response.erro){
                    $("#street").val('');
                    $("#neighborhood").val('');
                    $("#city").val('');
                    $("#state").val('');
                    $("#zipcode").val('');
                    alert('Endereço não encontrado');
                    return;                    
                }
                $("#street").val(response.logradouro);
                $("#neighborhood").val(response.bairro);
                $("#city").val(response.localidade);
                $("#state").val(response.uf);
                $("#number").focus();
            });

        });
    </script>
    @endpush
@endsection