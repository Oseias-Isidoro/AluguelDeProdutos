<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customers;
use Faker\Generator as Faker;

$factory->define(Customers::class, function (Faker $faker) {
    return [
        'user_id' => factory('App\Models\User')->create()->id,
        'email' => $faker->unique()->safeEmail,
        'first_name' => $faker->name,
        'last_name' => $faker->lastName,
        'document' => $faker->numberBetween(10000000, 20000000),
        'phone_number' => $faker->phoneNumber
    ];
});
