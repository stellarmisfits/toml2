<?php

use App\Models\Validator;
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

$factory->define(Validator::class, function (Faker $faker) {
    $country = $faker->country;
    return [
        'name' => $country,
        'alias' => substr(str_slug(str_random(15)), 0, 15),
        'host' => $faker->url,
        'history' => $faker->url,
    ];
});
