<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dish;
use Faker\Generator as Faker;



$factory->define(Dish::class, function (Faker $faker) {
  $foodfaker = \Faker\Factory::create();
  $foodfaker->addProvider(new \FakerRestaurant\Provider\it_IT\Restaurant($foodfaker));
    return [
        'name'         => $foodfaker -> foodName(),
        'description'  => $faker -> sentence,
        'price'        =>           rand(10,100),
        'availability' =>           rand(0, 1),
        'img'          => $faker -> imageUrl
    ];
});
