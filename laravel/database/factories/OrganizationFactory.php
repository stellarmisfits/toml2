<?php

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

$factory->define(App\Models\Organization::class, function (Faker $faker) {
    return [
        'name' => trim(substr($faker->name, 0, 20)),
        'alias' => substr($faker->slug, 0, 12),
    ];
});
