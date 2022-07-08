<?php

namespace App\Services;

use App\Models\Customers;

class CustomerService
{
    public function findCustomerById($id, array $with = [])
    {
        return Customers::with($with)->find($id);
    }

    /**
     * @throws \Exception
     */
    public function create(array $customer_data): Customers
    {
        $customer = Customers::create($customer_data);

        if (!$customer)
            throw new \Exception('Error at saving customer');

        (new CustomerAddresseService($customer))
            ->create($customer_data['address']);

        return $customer;
    }

    /**
     * @throws \Exception
     */
    public function update($id, array $customer_data)
     {
         $customer = Customers::find($id);

         if (!$customer->update($customer_data))
             throw new \Exception('Error at updating customer');

         (new CustomerAddresseService($customer))->updateOrCreate($customer_data['address']);

         return $customer;
     }
}
