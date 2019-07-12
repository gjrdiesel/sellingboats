<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
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

$factory->define(\App\Sale::class, function (Faker $faker) {
    return [
        'boat_id' => function () {
            return factory(\App\Boat::class)->create();
        },
        'sold_at' => $faker->dateTimeBetween(),
        'status'  => $faker->randomElement(\App\Sale::$statuses),
        'price'   => rand(32000, 92000),
    ];
});
