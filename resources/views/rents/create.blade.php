@extends('layouts.app')

@section('resources')
    <link href="{{ asset('css/products_index.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <form method="POST" action="{{route('rents.store')}}">
            @csrf

            <div class="mb-3">
                <label for="customer_id" class="form-label">Cliente</label>
                <select name="customer_id" id="customer_id">
                    @foreach($customers as $customer)
                        <option value="{{$customer->id}}">nome: {{$customer->getFullName()}} CPF: {{$customer->document}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="product_id" class="form-label">Produtos</label>
                <select name="product_id" id="product_id">
                    @foreach($products as $product)
                        <option value="{{$product->id}}">
                            {{$product->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="lease_start_date" class="form-label">Inicio do Aluguel</label>
                        <input name="lease_start_date" type="date" class="form-control" id="lease_start_date">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="lease_end_date" class="form-label">Fim do Aluguel</label>
                        <input name="lease_end_date" type="date" class="form-control" id="lease_end_date">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="cost" class="form-label">Custo</label>
                        <input name="cost" type="number" step="any" class="form-control" id="cost">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="additional_charge" class="form-label">Custo adicional</label>
                        <input name="additional_charge" step="any" type="number" class="form-control" id="additional_charge">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="maintenance_cost" class="form-label">Custo de manuntenção</label>
                        <input name="maintenance_cost" step="any" type="number" class="form-control" id="maintenance_cost">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="damage_rate" class="form-label">Taxa por danos</label>
                        <input name="damage_rate" step="any" type="number" class="form-control" id="damage_rate">
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
@endsection

