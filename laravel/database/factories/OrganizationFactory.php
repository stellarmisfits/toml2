<?php

use Faker\Generator as Faker;
use Spatie\Regex\Regex;

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

$factory->define(App\Models\Organization::class, function (Faker $faker) {
    $slug = strtolower(str_random(12));
    return [
        'name' => trim(substr($faker->name, 0, 20)),
        'alias' => Regex::replace('/[^a-z]/', '', $slug)->result()
    ];
});
