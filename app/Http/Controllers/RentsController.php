<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRest;
use App\Http\Requests\UpdateRent;
use App\Models\Customers;
use App\Models\Products;
use App\Models\Rents;
use App\Services\RentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RentsController extends Controller
{
    public function create()
    {
        $customers = Customers::get();
        $products = Products::where('user_id', Auth::id())->get();

        return view('rents.create', compact('products', 'customers'));
    }

    /**
     * @throws \Exception
     */
    public function store(StoreRest $request): \Illuminate\Http\RedirectResponse
    {
        /** @noinspection PhpParamsInspection */
        (new RentService(Auth::user()))
            ->create($request);

        return redirect()
            ->route('home')
            ->with('success', 'Aluguel salvo com sucesso!.');
    }

    public function edit($id)
    {
        $rent = Rents::find($id);
        $customers = Customers::get();
        $products = Products::where('user_id', Auth::id())->get();

        return view('rents.edit', compact('rent', 'customers', 'products'));
    }

    /**
     * @throws \Exception
     */
    public function update($id, UpdateRent $request): RedirectResponse
    {
        (new RentService(Auth::user()))
            ->update($id, $request);

        return redirect()
            ->route('home')
            ->with('success', 'Aluguel atualizado com sucesso!.');
    }
}
