<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();

            $table->string('name',60);
            $table->string('address',100);
            $table->string('city',40);
            $table->string('url',100)->nullable();
            $table->string('logo')->nullable();
            $table->string('phone',30);
            $table->string('piva',15);
            $table->integer('vote')->nullable();

            $table->bigInteger('user_id')->unsigned();
            $table->softDeletes();

            $table->timestamps();
        });

        Schema::table('restaurants', function (Blueprint $table) {
            $table->foreign('user_id')
                 ->references('id')
                 ->on('users');
                });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');

    }
}
