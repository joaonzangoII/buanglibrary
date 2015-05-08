<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model {

	protected $table = 'book_categories';

	public function books(){
		return $this->hasMany("App\Book");
	}

}
