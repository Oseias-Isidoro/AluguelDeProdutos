<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Models\Products;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;

class ProductsController extends Controller
{
    public function index()
    {
        $products = (new ProductService())->all();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function edit($product)
    {
        $product = Products::find($product);

        return view('products.edit', compact('product'));
    }

    /**
     * @param StoreProduct $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(StoreProduct $request): RedirectResponse
    {
        (new ProductService())
            ->create($request->toArray());

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto salvo com sucesso!.');
    }

    /**
     * @throws \Exception
     */
    public function update($id, UpdateProduct $request): RedirectResponse
    {
        (new ProductService())
            ->update($id, $request->toArray());

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto atualizado com sucesso!.');
    }
}
