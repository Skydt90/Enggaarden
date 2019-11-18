<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ActivityType;
use Faker\Generator as Faker;

$factory->define(ActivityType::class, function (Faker $faker) {
    return [
        'activity_type' => $faker->sentence(2, false)
    ];
});
