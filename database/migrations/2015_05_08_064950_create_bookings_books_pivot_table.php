<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsBooksPivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookings_books', function(Blueprint $table)
		{
			$table->integer('booking_id')->unsigned()->index();
			$table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
			$table->integer('book_id')->unsigned()->index();
			$table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bookings_books');
	}

}
