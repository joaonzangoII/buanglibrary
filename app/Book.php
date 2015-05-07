<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Book extends Model implements SluggableInterface{

  use SluggableTrait;
	protected $table = 'books';
  protected $fillable =
  [
    "title",
    "name",
    "title",
    "author",
    "edition",
    "isbn",
    "total_num_books",
    "avail_books",
    "year",
    "price",
    "user_id",
    "category_id",
    "published_at"
  ];

  protected $dates = ["published_at"];
  protected $sluggable = array(
    'build_from' => 'fulltitle',
    'save_to'    => 'slug',
    'on_update'  => true
  );
	public function user(){
		return $this->belongsTo("App\User");
	}

  public function cover(){
    return $this->hasOne("App\Cover");
  }

  // public function getCoverAttribute($cover){
  //   return "hello/" . $cover;
  // }

	public function category(){
		return $this->belongsTo("App\Category");
	}

  public  function scopeLike($query, $field, $value){
    return $query->where($field, 'LIKE', "%$value%");
  }

   public function getFulltitleAttribute()
   {  
     // dd($this->name);
     return $this->name . '-' . $this->title;
   }
}
