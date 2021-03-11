<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'name'    => $faker -> company,
        'address' => $faker -> streetAddress,
        'city'=> $faker -> randomElement($array = array (
            'roma',
            'milano',
            'Latina',
            'Messina',
            'Monza'
        )),
        'url'     => $faker -> url,
        'logo'    => null,
        'phone'   => $faker -> e164PhoneNumber,
        'vote'    =>           rand(1,5)
    ];
});
