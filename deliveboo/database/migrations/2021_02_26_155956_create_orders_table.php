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
            $table -> integer('price') -> nullable();
            $table -> string('date') -> nullable();
            $table -> string('phone',20) -> nullable();
            $table -> boolean('status') -> nullable();

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
