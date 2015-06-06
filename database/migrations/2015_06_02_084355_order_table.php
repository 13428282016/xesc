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
            $table->string('order_no',32);
            $table->decimal('price',10,2)->unsigned();
            $table->string('remark',32);
            $table->dateTime('pay_at');
            $table->integer('pay_type')->unsigned();
            $table->dateTime('confirm_at');
            $table->timestamps();
            $table->softDeletes();
//            $table->decimal('freight',10,2)->unsigned();

            $table->string('phone',12);
            $table->string('address',255);

            $table->integer('buyer_id')->unsigned();
            $table->tinyInteger('status')->unsigned();
            $table->text('receiver_info');
            $table->dateTime('accepted_at');

            $table->string('recv_cellphone',14);

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
