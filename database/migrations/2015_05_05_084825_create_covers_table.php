<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoversTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('covers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('alt');
			$table->string('image');
			$table->integer('book_id');
			// $table->foreign('book_id')->references('id')->on('book')->onDelete('cascade');
			$table->timestamp('published_at');
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
		Schema::drop('covers');
	}

}
