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
        'img'          => 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.triptosicily.com%2Fwp-content%2Fuploads%2F2016%2F10%2FPani_ca_meusa.jpg&f=1&nofb=1'
    ];
});
