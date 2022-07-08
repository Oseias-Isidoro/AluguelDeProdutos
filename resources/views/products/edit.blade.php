@extends('layouts.app')

@section('resources')
    <link href="{{ asset('css/products_index.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h3>Editando produto <span class="fw-bold">{{$product->name }}</span></h3>
        <form method="POST" action="{{route('products.update', ['product' => $product->id])}}"  enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="input-group mb-3">
                <label class="input-group-text" for="img">Upload</label>
                <input name="img" type="file" class="form-control" id="img">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input name="name" value="{{$product->name}}" type="text" class="form-control" id="name">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">preço</label>
                <input value="{{$product->price}}" type="number" min="1" step="any" name="price" class="form-control" id="price" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="inventory" class="form-label">estoque</label>
                <input value="{{$product->inventory}}" name="inventory" type="number" class="form-control" id="inventory" required>
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

