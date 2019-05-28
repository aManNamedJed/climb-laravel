<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'contact_name' => $faker->name,
    ];
});
