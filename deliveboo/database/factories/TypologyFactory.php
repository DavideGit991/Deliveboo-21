<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Typology;
use Faker\Generator as Faker;

$factory->define(Typology::class, function (Faker $faker) {
    return [
      'name'=> $faker -> unique -> randomElement($array = array (
          'Giapponese',
          'Asiatico',
          'Italiano',
          'Indiano',
          'Cinese',
          'Messicano',
          'Libanese',
          'Mediterraneo',
          'Fast Food',
          'Pizzeria'
      )),

      'description'=> $faker -> sentence
    ];
});
