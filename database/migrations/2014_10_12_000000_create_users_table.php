<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_number');
			$table->string('fullname');
			$table->string('fname');
			$table->string('lname');
			$table->string('address');
			$table->string('user_type');
			$table->string('id_number');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->string('phone', 10)->nullable();
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
