<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
class UserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('users',function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('open_id',32);
            $table->char('cellphone',11);
            $table->string('last_login_ip',15);
            $table->dateTime('last_login_at');
            $table->integer('login_times')->unsigned();
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
        Schema::drop('users');
	}

}
