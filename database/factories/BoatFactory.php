<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Boat;
use Illuminate\Support\Str;
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

$factory->define(Boat::class, function (Faker $faker) {

    $boats = [
        [
            'make' => 'Hewes',
            'models' => ['Redfisher 16', 'Redfisher 18'],
        ],
        [
            'make' => 'Boston Whaler',
            'models' => ['Super Sport', 'Montauk', 'Duantless', 'Vantage', 'Conquest'],
        ],
        [
            'make' => 'Cobia',
            'models' => ['201CC', '220CC', '240CC', '261CC', '21 Bay', '240 Dual Console'],
        ]
    ];

    $boat = $faker->randomElement($boats);
    $boat['model'] = $faker->randomElement($boat['models']);

    return [
        'year' => $faker->year,
        'make' => $boat['make'],
        'model' => $boat['model'],
        'serial_number' => $faker->md5,
        'stock_number' => $faker->numerify('###-###'),
        'list_price' => rand(100000, 400000)
    ];
});
