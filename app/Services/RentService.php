<?php

namespace App\Services;

use App\Models\Rents;
use App\Models\User;

class RentService
{
    private User $user;
    private string $default_status = 'in_progress';

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @throws \Exception
     */
    public function create(object $rent_data): Rents
    {
        $rest = new Rents();

        $rest->user_id           = $this->user->id;
        $rest->customer_id       = $rent_data->customer_id;
        $rest->product_id        = $rent_data->product_id;
        $rest->lease_start_date  = $rent_data->lease_start_date . ' 00:00:00';
        $rest->lease_end_date    = $rent_data->lease_end_date . ' 00:00:00';
        $rest->cost              = $rent_data->cost;
        $rest->additional_charge = $rent_data->additional_charge;
        $rest->maintenance_cost  = $rent_data->maintenance_cost;
        $rest->damage_rate       = $rent_data->damage_rate;
        $rest->status            = $this->default_status;

        if (!$rest->save())
            throw new \Exception('Error at save rent');

        return $rest;
    }

    /**
     * @throws \Exception
     */
    public function update(int $id, object $rent_data): Rents
    {
        $rent = Rents::find($id);

        $rent->customer_id       = $rent_data->customer_id;
        $rent->product_id        = $rent_data->product_id;
        $rent->lease_start_date  = $rent_data->lease_start_date . ' 00:00:00';
        $rent->lease_end_date    = $rent_data->lease_end_date . ' 00:00:00';
        $rent->cost              = $rent_data->cost;
        $rent->additional_charge = $rent_data->additional_charge;
        $rent->maintenance_cost  = $rent_data->maintenance_cost;
        $rent->damage_rate       = $rent_data->damage_rate;
        $rent->status            = $rent_data->status;


        if (!$rent->update())
            throw new \Exception('Error at updating rent');

        return $rent;
    }

    public function paginatedRentals(int $count): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Rents::with(['product', 'customer'])
            ->where('user_id', $this->user->id)
            ->orderBy('id', 'DESC')
            ->paginate($count);
    }
}
