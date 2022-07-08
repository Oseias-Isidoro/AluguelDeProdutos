@extends('layouts.app')

@section('resources')
    <link href="{{ asset('css/products_index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="d-flex flex-row-reverse mb-2">
        <a href="{{route('rents.create')}}">
            <button type="button" class="btn btn-primary">Criar Aluguel</button>
        </a>
    </div>

    @foreach($rents as $rent)
        <a href="{{route('rents.edit', ['id' => $rent->id])}}">
            <div class="product {{ $rent->getCssStatus() }}  d-flex p-2 my-2 text-white rounded">
                <img src="{{asset($rent->product->img_path)}}" class="img-thumbnail flex-shrink-1" width="100" alt="...">
                <div class="w-100 p-2">
                    <div class=" product_name">
                        Nome: {{$rent->customer->getFullName()}}
                    </div>
                    <div class=" product_name">
                        Rroduto: {{$rent->product->name}}
                    </div>
                    <div class=" product_name">
                        Custo: {{$rent->cost}}
                    </div>
                    <div class=" product_name">
                        Status: {{$rent->status}}
                    </div>
                </div>
            </div>
        </a>
    @endforeach

    {{ $rents->links() }}
</div>
@endsection
