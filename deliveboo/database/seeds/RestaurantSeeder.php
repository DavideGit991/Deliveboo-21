<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use App\User;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Restaurant::class, 35)
        -> make()

        -> each(function($restaurant){

            $user=User::inRandomOrder()->first();

            $restaurant->user() -> associate($user) -> save();
        });
    }
}
