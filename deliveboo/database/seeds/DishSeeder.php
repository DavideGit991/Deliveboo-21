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
            // $finito=false;
            // $a=1;

            // while ($a <= 20 ) {
            //     if (condition) {
            //         # code...
            //     } idRestaurant=Restaurant::

            //     for ($i=1; $i < 5; $i++) {

                   $restaurant=Restaurant::inRandomOrder()->first();
                   $dish-> restaurant() -> associate($restaurant);

            //\     }
            //     $a++;
            //     $finito=true;
                $dish->save();
            // }
        });
    }
}
