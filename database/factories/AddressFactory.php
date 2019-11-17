<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'street_name' => $faker->streetAddress(),
        'zip_code' => $faker->randomNumber(4),
        'city' => $faker->city(),
    ];
});
