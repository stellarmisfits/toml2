<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Asset::class, function (Faker $faker) {
    return [
        'code' => strtoupper(str_random(12)),
        'display_decimals' => 0,
        'name' => $faker->company,
        'desc' => $faker->text(),
        'conditions' => $faker->text()
    ];
});
