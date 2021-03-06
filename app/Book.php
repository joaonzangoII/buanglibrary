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
    "author",
    "edition",
    "isbn",
    "total_num_books",
    "avail_books",
    "year",
    "price",
    "user_id",
    "book_category_id",
    "published_at"
  ];

  protected $dates = ["published_at"];
  protected $sluggable = array(
    'build_from' => 'title',
    'save_to'    => 'slug',
    'on_update'  => true
  );
	public function user(){
		return $this->belongsTo("App\User");
	}

  public function cover(){
    return $this->hasOne("App\Cover");
  }
  
	public function book_category(){
		return $this->belongsTo("App\BookCategory");
	}

   public function booking()
   {
      return $this->belongsToMany('App\Book',"bookings_books");
   }

  public  function scopeLike($query, $field, $value){
    return $query->where($field, 'LIKE', "%$value%");
  }

  public function scopeFreesearch($query, $value)
  {
    return $query->where('title','like','%'.$value.'%')
      ->orWhere('author','like','%'.$value.'%')
      ->orWhere('edition','like','%'.$value.'%');
      // ->orWhereHas('author', function ($q) use ($value) {
      //     $q->whereRaw(" CONCAT(firstname, ' ', lastname) like ?", array("%".$value."%"));
      // })->orWhereHas('categories', function ($q) use ($value) {
      //     $q->where('name','like','%'.$value.'%');
      // });
  }

   // public function getFulltitleAttribute()
   // {  
   //   // dd($this->name);
   //   return $this->name . '-' . $this->title;
   // }
}
