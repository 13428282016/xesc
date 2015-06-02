<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DishesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('dishes',function(Blueprint $table){
            $table->increments('id');
            $table->string('name',16);
            $table->string('image',255);
            $table->decimal('price',10,2);
            $table->string('desc',255);
            $table->tinyInteger('status')->unsigned();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::drop('dishes');
	}

}
