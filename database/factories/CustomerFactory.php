<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Customer;
use Faker\Generator as Faker;

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

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name'  => $faker->lastName,
        'address'    => $faker->address,
        'email'      => $faker->email,
        'phone'      => $faker->phoneNumber,
    ];
});
