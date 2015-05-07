<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("name");
			$table->string("title");
			$table->string("description");
			$table->string("author");
			$table->string("edition");
			$table->string("isbn");
			$table->string("total_num_books");
			$table->string("avail_books");
			$table->string("year");
			$table->integer("category_id");
			$table->decimal("price");
			$table->string("slug");
			$table->string("cover_id");
			$table->integer("user_id");
			$table->timestamp("published_at");
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
		Schema::drop('books');
	}

}
