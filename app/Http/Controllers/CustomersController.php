<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomer;
use App\Http\Requests\UpdateCustomer;
use App\Models\Customers;
use App\Services\CustomerService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 *
 */
class CustomersController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $all_customers = Customers::orderBy('id', 'DESC')->paginate(10);
        return view('customers.index', compact('all_customers'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * @param StoreCustomer $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(StoreCustomer $request): RedirectResponse
    {
        (new CustomerService())->create($request->toArray());

        return redirect()->route('customers.index')
            ->with('success', 'Cliente salvo com sucesso!.');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $customer = (new CustomerService())->findCustomerById($id, ['addresses']);

        return view('customers.edit', compact('customer'));
    }

    /**
     * @param $customer
     * @param UpdateCustomer $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function update($customer, UpdateCustomer $request): RedirectResponse
    {
        (new CustomerService())->update($customer, $request->toArray());

        return redirect()->route('customers.index')
            ->with('success', 'Cliente atualizado com sucesso!.');
    }
}
