<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
      'name'     => $faker -> firstName,
      'lastname' => $faker -> lastName,
      'address'  => $faker -> streetAddress,
      'tot_price'    => $faker ->randomFloat($nbMaxDecimals = 1, $min = 20, $max = 100),
      'month'     => rand(1,12),
      'phone'    => $faker -> e164PhoneNumber,
      'status'   =>           rand(0, 1)
    ];
});
