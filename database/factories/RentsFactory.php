<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Rents;
use Faker\Generator as Faker;

$factory->define(Rents::class, function (Faker $faker) {
    return [
        'user_id' => factory('App\Models\User')->create()->id,
        'customer_id' => factory('App\Models\Customers')->create()->id,
        'product_id' => factory('App\Models\Products')->create()->id,
        'lease_start_date' => $faker->dateTime,
        'lease_end_date' => $faker->dateTime,
        'additional_charge' => $faker->numberBetween(23, 45),
        'maintenance_cost' => $faker->numberBetween(23, 45),
        'damage_rate' => $faker->numberBetween(23, 45),
        'cost' => $faker->numberBetween(23, 45),
        'status' => $faker->randomElement(['late', 'in_progress', 'finished']),
    ];
});
