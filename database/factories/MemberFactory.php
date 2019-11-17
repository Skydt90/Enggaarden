<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'email' => $faker->unique()->email(),
        'phone_number' => $faker->randomNumber(8),
        'member_type' => Member::MEMBER_TYPES[$faker->numberBetween(0, 2)],
        'is_board' => $faker->boolean(),
    ];
});
