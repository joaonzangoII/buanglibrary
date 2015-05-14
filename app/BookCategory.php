<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model {

	protected $table = 'book_categories';
  protected $fillable = [
     "name",
   ];
	public function books(){
		return $this->hasMany("App\Book");
	}

}
