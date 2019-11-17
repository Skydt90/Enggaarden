<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ExternalUser;
use Faker\Generator as Faker;

$factory->define(ExternalUser::class, function (Faker $faker) {
    return [
        'email' => $faker->email(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password is password
    ];
});
