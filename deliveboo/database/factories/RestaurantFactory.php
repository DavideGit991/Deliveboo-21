<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'name'=> $faker ->  word,
        'address'=> $faker -> address,
        'city'=> $faker -> word,
        'url'=> $faker -> url,
        'logo'=> $faker -> imageUrl,
        'phone'=> $faker -> phoneNumber,
        'vote'=>  rand(1,5),

    ];
});
