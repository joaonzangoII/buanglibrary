<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingSequencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('booking_sequences', function(Blueprint $table)
		{
			$table->increments('id');
			// $table->integer('id', true, false);
			$table->timestamp('date');
			$table->timestamps();
			// $table->primary(array('id', 'date'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('booking_sequences');
	}

}
