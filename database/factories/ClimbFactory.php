<?php

use Faker\Generator as Faker;
use App\Climb;

$factory->define(App\Climb::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'color' => 'blue',
        'description' => $faker->paragraph(),
        'grade' => Climb::getRandomGrade(),
        'setter_id' => 1
    ];
});