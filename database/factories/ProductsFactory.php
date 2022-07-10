<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Products;
use Faker\Generator as Faker;

$factory->define(Products::class, function (Faker $faker) {
    return [
        'user_id' => factory('App\Models\User')->create()->id,
        'name' => $faker->name,
        'price' => $faker->numberBetween(32, 45),
        'inventory' => $faker->numberBetween(0, 34),
        'img_path' => $faker->paragraph
    ];
});
