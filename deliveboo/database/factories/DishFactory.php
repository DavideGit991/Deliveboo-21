<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dish;
use Faker\Generator as Faker;

$factory->define(Dish::class, function (Faker $faker) {
    return [
        'name'=> $faker -> word,
        'description'=> $faker -> sentence,
        'price'=> rand(10,100),
        'availability'=> rand(true, false),
        'img'=> $faker -> imageUrl,
    ];
});
