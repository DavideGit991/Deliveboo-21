<?php

use Illuminate\Database\Seeder;
use App\Dish;
use App\Restaurant;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public $a=1;

    public function run()
    {



        factory(Dish::class, 100)
        -> make()
        ->each(function($dish){

            $restaurant=Restaurant::inRandomOrder()->first();
            $dish-> restaurant() -> associate($restaurant);

            $dish->save();

        });
    }
}
