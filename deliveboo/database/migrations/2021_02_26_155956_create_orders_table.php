<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table -> id();

            $table -> string('name',60) -> nullable();
            $table -> string('lastname',60) -> nullable();
            $table -> string('address',60) -> nullable();
            $table -> float('tot_price') -> nullable();
            $table -> integer('month') -> nullable();
            $table -> string('phone',15) -> nullable();
            $table -> boolean('status') -> nullable();
            $table -> string('mail') ->unique() -> nullable();

            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
