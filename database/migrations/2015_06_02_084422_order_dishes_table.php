<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class OrderDishesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('order_dishes_mid',function(Blueprint $table)
        {
            $table->integer('order_id')->unsigned();
            $table->integer('dishes_id')->unsigned();
            $table->integer('dishes_amount')->unsigned();
            $table->string('dishes_name',16);
            $table->string('dishes_image',255);
            $table->decimal('dishes_price',10,2)->unsigned();
//            $table->timestamps();

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
        Schema::drop('order_dishes_mid');
	}

}
