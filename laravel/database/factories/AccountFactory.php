<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Account::class, function (Faker $faker) {
    return [
        'public_key' => strtoupper(str_random(56))
    ];
});
