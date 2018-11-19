<?php

use Faker\Generator as Faker;

$factory->define(App\Climb::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'color' => 'blue',
        'grade' => '5.7',
        'setter_id' => 1
    ];
});