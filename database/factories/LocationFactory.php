<?php

use Faker\Generator as Faker;
use App\Location;

$factory->define(App\Location::class, function (Faker $faker) {
    return [
        'company_id' => 1,
        'address_id' => 1
    ];
});
