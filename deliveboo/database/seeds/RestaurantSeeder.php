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
      factory(Restaurant::class, 20)
        -> make()
        -> each(function($restaurant, $key){
            $id=$key+1;
            $user=User::where('id','=',$id)->first();  
            $restaurant->user() -> associate($user)->save();
        });
    }
}
