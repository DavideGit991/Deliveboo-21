<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'name'    => $faker -> company,
        'address' => $faker -> streetAddress,
        'city'=> $faker -> randomElement($array = array (
            'roma',
            'milano',
            'Latina',
            'Messina',
            'Monza'
        )),
        'url'     => $faker -> url,
        'logo'    => 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.YzPjGN3-IpREOjomoY-PjgHaD8%26pid%3DApi&f=1',
        'phone'   => $faker -> e164PhoneNumber,
        'vote'    =>           rand(1,5)
    ];
});
