<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CartDishesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('cart_dishes_mid',function(Blueprint $table){

            $table->integer('dishes_id')->unsigned();
            $table->integer('cart_id')->unsigned();
			$table->float('price');
			$table->integer('amount');
			$table->timestamps();



        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::drop('cart_dishes_mid');
	}

}
