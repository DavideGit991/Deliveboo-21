<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
      'name' => $faker->firstName,
      'last_name' => $faker->lastName,
      'address' => $faker->streetAddress,
      'price' => rand(10,10000),
      'mouth' => monthName($max = 'now'),
      'email' => $faker->email,
      'phone' => $faker->e164PhoneNumber,
      'status' => $faker->rand(0,1),
    ];
});
