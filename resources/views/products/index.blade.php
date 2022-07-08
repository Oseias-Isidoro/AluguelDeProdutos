@extends('layouts.app')

@section('resources')
    <link href="{{ asset('css/products_index.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="d-flex flex-row-reverse mb-2">
            <a href="{{route('products.create')}}">
                <button type="button" class="btn btn-primary">Criar Produto</button>
            </a>
        </div>
        @foreach($products as $product)
            <a href="{{route('products.edit', ['product' => $product->id])}}">
                <div class="product d-flex p-2 my-2 text-white rounded">
                    <img src="{{asset($product->img_path)}}" class="img-thumbnail flex-shrink-1" width="100" alt="...">
                    <div class="w-100 p-2">
                        <div class=" product_name">
                            Nome: {{$product->name}}
                        </div>
                        <div class=" product_name">
                            Preço: {{$product->price}}
                        </div>
                        <div class=" product_name">
                            Estoque: {{$product->inventory}}
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
        {{ $products->links() }}
    </div>
@endsection

