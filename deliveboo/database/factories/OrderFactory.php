<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
      'name'     => $faker -> firstName,
      'lastname' => $faker -> lastName,
      'address'  => $faker -> streetAddress,
      'price'    =>           rand(10,10000),
      'date'     => $faker -> monthName($max = 'now'),
      'phone'    => $faker -> e164PhoneNumber,
      'status'   =>           rand(0, 1)
    ];
});
