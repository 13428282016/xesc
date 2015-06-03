<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class ShipAddrTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
       Schema::create('ship_addrs',function(Blueprint $table){

           $table->increments("id");
           $table->integer('user_id')->unsigned();
           $table->string('address',32);
//           $table->string('sex',1);
//           $table->string('name',6);
           $table->char('cellphone',11);
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
        Schema::drop('ship_addrs');
	}

}
