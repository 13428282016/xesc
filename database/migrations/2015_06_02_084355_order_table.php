<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
class OrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('orders',function(Blueprint $table){

            $table->increments('id');
            $table->decimal('price',10,2)->unsigned();
            $table->string('remark',32);
            $table->dateTime('pay_at');
            $table->integer('pay_type')->unsigned();
            $table->dateTime('confirm_at');
            $table->timestamps();
            $table->softDeletes();
            $table->decimal('freight',10,2)->unsigned();
            $table->integer('buyer_id')->unsigned();
            $table->tinyInteger('status')->unsigned();
            $table->text('receiver_info');
            $table->dateTime('accepted_at');

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
        Schema::drop('orders');
	}

}