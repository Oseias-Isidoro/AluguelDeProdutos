@extends('layouts.app')

@section('resources')
    <link href="{{ asset('css/products_index.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h3>Editando aluguel ID: <span class="fw-bold">{{$rent->id }}</span></h3>
        <form method="POST" action="{{route('rents.update', ['rent' => $rent->id])}}" >
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="customer_id" class="form-label">Cliente</label>
                <select name="customer_id" id="customer_id">
                    @foreach($customers as $customer)
                        <option {{ $customer->id === $rent->customer_id ? 'selected' : '' }} value="{{$customer->id}}">nome: {{$customer->getFullName()}} CPF: {{$customer->document}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="product_id" class="form-label">Produtos</label>
                <select name="product_id" id="product_id">
                    @foreach($products as $product)
                        <option {{ $product->id === $rent->product_id ? 'selected' : '' }} value="{{$product->id}}">
                            {{$product->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="lease_start_date" class="form-label">Inicio do Aluguel</label>
                        <input name="lease_start_date" type="date" value="{{str_replace(" 00:00:00", '', $rent->lease_start_date)}}" class="form-control" id="lease_start_date">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="lease_end_date" class="form-label">Fim do Aluguel</label>
                        <input name="lease_end_date" type="date"  value="{{str_replace(" 00:00:00", '', $rent->lease_end_date)}}" class="form-control" id="lease_end_date">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="cost" class="form-label">Custo</label>
                        <input name="cost" type="number" step="any" value="{{$rent->cost}}" class="form-control" id="cost">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="additional_charge" class="form-label">Custo adicional</label>
                        <input name="additional_charge" step="any" value="{{$rent->additional_charge}}" type="number" class="form-control" id="additional_charge">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="maintenance_cost" class="form-label">Custo de manuntenção</label>
                        <input name="maintenance_cost" step="any" value="{{$rent->maintenance_cost}}" type="number" class="form-control" id="maintenance_cost">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="damage_rate" class="form-label">Taxa por danos</label>
                        <input name="damage_rate" step="any" value="{{$rent->damage_rate}}" type="number" class="form-control" id="damage_rate">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status">
                    <option {{$rent->status === 'in_progress' ? 'selected' : ''}} value="in_progress">em processo</option>
                    <option {{$rent->status === 'late' ? 'selected' : ''}} value="late">atrasado</option>
                    <option {{$rent->status === 'finished' ? 'selected' : ''}} value="finished">terminado</option>
                </select>
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

