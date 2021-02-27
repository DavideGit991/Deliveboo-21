<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // chiavi secondarie tabella ponte piatti ordini
        Schema::table('dish_order', function (Blueprint $table) {
           $table->foreign('dish_id','d_o')
                ->references('id')
                ->on('dishes');

            $table->foreign('order_id','o_d')
                ->references('id')
                ->on('orders');
        });
        // chiavi secondarie tabella ponte ristoranti tipologie
        Schema::table('restaurant_typology', function (Blueprint $table) {
            $table->foreign('restaurant_id','r_t')
                 ->references('id')
                 ->on('restaurants');

             $table->foreign('typology_id','t_r')
                 ->references('id')
                 ->on('typologies');
         });

        //  chiave secondaria presente nella tabella piatto
         Schema::table('dishes', function (Blueprint $table) {
            $table->foreign('restaurant_id','r_d')
                 ->references('id')
                 ->on('restaurants');

         });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurant_typology', function (Blueprint $table) {
            $table->dropForeign('t_r');
            $table->dropForeign('r_t');

        });

        Schema::table('dish_order', function (Blueprint $table) {
            $table->dropForeign('o_d');
            $table->dropForeign('d_o');

        });

        Schema::table('dishes', function (Blueprint $table) {
            $table->dropForeign('r_d');

        });

    }
}
