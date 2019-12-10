<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'email' => $faker->unique()->email(),
        'phone_number' => $faker->randomNumber(8, true),
        'member_type' => Member::MEMBER_TYPES[$faker->numberBetween(0, 2)],
        'is_board' => Member::IS_BOARD[$faker->numberBetween(0, 1)],
        'created_at' => $faker->dateTimeBetween('-2 years', 'now')
    ];
});

$factory->state(Member::class, 'company',function (Faker $faker){
    return [
        'first_name' => $faker->company(),
        'last_name' => null,
        'email' => $faker->unique()->email(),
        'phone_number' => $faker->randomNumber(8, true),
        'member_type' => 'Ekstern',
        'is_board' => 'Nej',
        'is_company' => true
    ];
});
