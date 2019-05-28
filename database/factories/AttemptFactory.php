<?php

use Faker\Generator as Faker;

$factory->define(App\Attempt::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'climb_id' => $faker->numberBetween(1, 1250),
        'is_successful' => true,
        'has_falls' => true
    ];
});
