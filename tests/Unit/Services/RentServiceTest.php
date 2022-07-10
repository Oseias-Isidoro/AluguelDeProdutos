<?php

namespace Services;

use App\Models\Customers;
use App\Models\Products;
use App\Models\Rents;
use App\Models\User;
use App\Services\RentService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RentServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @throws \Exception
     */
    public function testUpdate()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $customer = factory(Customers::class)->create(['user_id' => $user->id]);
        $product = factory(Products::class)->create(['user_id' => $user->id]);
        $rent = factory(Rents::class)->create(['user_id' => $user->id]);

        $updatedRent = (new RentService())->update($rent->id, [
            'customer_id' => $customer->id,
            'product_id' => $product->id,
            'lease_start_date' => '2022-07-18 01:40:31',
            'lease_end_date' => '2022-07-20 01:40:31',
            'additional_charge' => 45,
            'maintenance_cost' => 46,
            'cost' => 47,
            'damage_rate' => 48,
            'status' => 'late',
        ]);

        $this->assertDatabaseHas('rents', $updatedRent->only([
            'customer_id',
            'product_id',
            'lease_start_date',
            'lease_end_date',
            'additional_charge',
            'maintenance_cost',
            'damage_rate',
            'status',
            'cost',
        ]));
    }

    /**
     * @throws \Exception
     */
    public function testCreate()
    {
        $user = factory(User::class)->create();
        $customer = factory(Customers::class)->create(['user_id' => $user->id]);
        $product = factory(Products::class)->create(['user_id' => $user->id]);

        $rent = (new RentService())->create([
            'user_id' => $user->id,
            'customer_id' => $customer->id,
            'product_id' => $product->id,
            'lease_start_date' => '2022-07-8 01:40:31',
            'lease_end_date' => '2022-07-10 01:40:31',
            'additional_charge' => 23,
            'maintenance_cost' => 23,
            'cost' => 23,
            'damage_rate' => 23,
            'status' => 'in_progress',
        ]);

        $this->assertNotNull($rent);;
    }
}
