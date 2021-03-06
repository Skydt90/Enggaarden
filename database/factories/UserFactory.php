<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->unique->firstName(),
        'user_type' => User::USER_TYPES[$faker->numberBetween(0, 1)],
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  // password is password
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'britta', function(Faker $faker) {
    return [
        'username' => 'britta',
        'user_type' => 'Administrator',
        'password' => '$2y$10$SVHYTn90cOCgqs.yZi9HiOThiU8yUn7qsKejlDNw/zwb4FJBha1WS' // 12345
    ];
});

$factory->state(User::class, 'iben', function(Faker $faker) {
    return [
        'username' => 'Iben',
        'user_type' => 'Administrator',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // 12345
    ];
});