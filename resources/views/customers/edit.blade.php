@extends('layouts.app')

@section('resources')
    <link href="{{ asset('css/customers_index.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h3>Editando cliente <span class="fw-bold">{{$customer->getFullName() }}</span></h3>
        <form method="POST" action="{{route('customers.update', ['customer' => $customer->id])}}">
            @csrf
                @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input value="{{$customer->getFullName()}}" name="name" type="text" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="{{$customer->email}}" type="email" name="email" class="form-control" id="email" placeholder="exemplo@gmail.com" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="document" class="form-label">Documento (CPF)</label>
                <input value="{{$customer->document}}" name="document" type="text" pattern="[0-9]{11}" class="form-control" id="document" required>
                <div id="emailHelp" class="form-text">Sem pontuação.</div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Telefone</label>
                <input value="{{$customer->phone_number}}" name="phone_number" type="tel" pattern="[0-9]{11}" placeholder="45999000000" class="form-control" id="phone" >
            </div>

            <hr>

            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <label for="zipcode" class="form-label">Cep</label>
                        <input value="{{$customer->addresses->zipcode ?? ''}}" name="address[zipcode]" type="text" class="form-control" id="zipcode" >
                    </div>
                </div>
                <div class="col d-flex p-3">
                    <button onclick="getByCep()" type="button" class="btn btn-primary">Buscar</button>
                </div>
            </div>

            <div class="row">
                <div class="col-10">
                    <div class="mb-3">
                        <label for="street" class="form-label">Rua</label>
                        <input value="{{$customer->addresses->street ?? ''}}" name="address[street]" type="text" class="form-control" id="street" >
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-3">
                        <label for="number" class="form-label">Numero</label>
                        <input value="{{$customer->addresses->number ?? ''}}" name="address[number]" type="number" class="form-control" id="number" >
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="district" class="form-label">Bairro</label>
                <input value="{{$customer->addresses->district ?? ''}}" name="address[district]" type="text" class="form-control" id="district" >
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="city" class="form-label">Cidade</label>
                        <input value="{{$customer->addresses->city ?? ''}}" name="address[city]" type="text" class="form-control" id="city">
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="state" class="form-label">Estado</label>
                        <input value="{{$customer->addresses->state ?? ''}}" name="address[state]" type="text" class="form-control" id="state" >
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="country" class="form-label">País</label>
                        <input value="{{$customer->addresses->country ?? ''}}" name="address[country]" type="text" class="form-control" id="country" >
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <script>
        function getByCep()
        {
            let cep = document.getElementById('zipcode').value

            fetch('https://viacep.com.br/ws/' + cep + '/json/')
                .then(T => T.json())
                .then(function (data) {
                    document.getElementById('street').value = data.logradouro
                    document.getElementById('district').value = data.bairro
                    document.getElementById('city').value = data.localidade
                    document.getElementById('state').value = data.uf
                    document.getElementById('country').value = 'Brasil'
                })
        }
    </script>
@endsection

