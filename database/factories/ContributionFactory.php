<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Contribution;
use Faker\Generator as Faker;

$factory->define(Contribution::class, function (Faker $faker) {
    return [
        'amount' => $faker->numberBetween(10, 1000),
        'payment_date' => $faker->date('Y-m-d', 'now')
    ];
});
