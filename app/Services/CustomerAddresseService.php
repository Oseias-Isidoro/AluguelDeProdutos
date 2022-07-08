<?php

namespace App\Services;

use App\Models\CustomerAddresses;
use App\Models\Customers;

class CustomerAddresseService
{
    private Customers $customer;

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @throws \Exception
     */
    public function create(array $customer_addresse_data): CustomerAddresses
    {
        $customer_addresse_data['customer_id'] = $this->customer->id;

        $customerAddresse = CustomerAddresses::create($customer_addresse_data);

        if (!$customerAddresse)
            throw new \Exception('Error at saving customer addresse');

        return $customerAddresse;
    }

    /**
     * @throws \Exception
     */
    public function updateOrCreate(array $customer_addresse_data): CustomerAddresses
    {
        $customerAddresse = CustomerAddresses::updateOrCreate(
            ['customer_id' => $this->customer->id],
            $customer_addresse_data
        );
        if (!$customerAddresse)
            throw new \Exception('Error at updating customer addresse');

        return $customerAddresse;
    }
}

