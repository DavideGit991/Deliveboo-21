<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'name'    => $faker-> unique -> randomElement($array = array (
            'da Ciro',
            'il pollino',
            'da Giuliano',
            'civico36',
            'circoloco',
            'nori restaurant',
            'birreria italiana',
            'orso bianco',
            'la mucca pazza',
            'voglia di pizza',
            'da Carlo',
            'velo',
            'bbq restaurant',
            'il ghiottone',
            'cacio e pepe',
            'strapizzami',
            'illegal burger',
            'piadineria Rimini',
            'pizza club',
            'manzo criminale',

        )),
        'address' => $faker -> streetAddress,
        'city'=> $faker -> randomElement($array = array (
            'roma',
            'milano',
            'Latina',
            'Messina',
            'Monza'
        )),
        'logo'    => null,
        'phone'   => $faker -> e164PhoneNumber,
        'vote'    =>           rand(1,5)
    ];
});
