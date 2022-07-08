@extends('layouts.app')

@section('resources')
    <link href="{{ asset('css/customers_index.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="d-flex flex-row-reverse mb-2">
            <a href="/customers/create">
                <button type="button" class="btn btn-primary">Criar Cliente</button>
            </a>
        </div>

        @foreach($all_customers as $customer)
            <a href="{{route('customers.edit', ['customer' => $customer->id])}}">
                <div class="customer rounded p-2 m-2">
                    <div class="customer_name">
                        <span class="fw-bold">Nome:</span> {{$customer->getFullName()}}
                        <span class="fw-bold">Documento:</span> {{"$customer->document"}}
                    </div>
                </div>
            </a>
        @endforeach
        {{ $all_customers->links() }}
    </div>
@endsection

