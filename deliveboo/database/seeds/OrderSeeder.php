<?php

use Illuminate\Database\Seeder;

use App\Typology;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Typology::class, 30)-> create();
    }
}
