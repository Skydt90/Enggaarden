<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Email;
use Faker\Generator as Faker;

$factory->define(Email::class, function (Faker $faker) {
    
    return [
        'subject' => $faker->text(30),
        'message' => $faker->text(300),
    ];
    
});
