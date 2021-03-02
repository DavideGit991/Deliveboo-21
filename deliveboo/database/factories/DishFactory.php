<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dish;
use Faker\Generator as Faker;

//$faker = \Faker\Factory::create();
//$faker->addProvider(new \FakerRestaurant\Provider\it_IT\Restaurant($faker));

$factory->define(Dish::class, function (Faker $faker) {
    return [
        //'name'         => $faker -> foodName(),
        'name'         => $faker -> word,
        'description'  => $faker -> sentence,
        'price'        =>           rand(10,100),
        'availability' =>           rand(0, 1),
        'img'          => $faker -> imageUrl
    ];
});
