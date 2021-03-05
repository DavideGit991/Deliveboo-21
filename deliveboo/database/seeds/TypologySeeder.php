<?php

use Illuminate\Database\Seeder;
use App\Typology;
use App\Restaurant;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Typology::class, 10)
          -> create()
          -> each(function($typology) {

              $restaurant = Restaurant::inRandomOrder()->limit(rand(5,6)) -> get();
              $typology -> restaurants() -> attach($restaurant);
          });
    }
}
