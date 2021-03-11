<?php

use Illuminate\Database\Seeder;

use App\Order;
use App\Restaurant;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 250)
            -> create()
            -> each(function($order) {
                $restaurant=Restaurant::inRandomOrder()->first();
                $dish = $restaurant->dishes()->inRandomOrder()->limit(rand(1,8))->get();
                $order -> dishes() -> attach($dish);
            });
      }

}
