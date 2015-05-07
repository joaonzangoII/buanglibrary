<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cover extends Model {

  protected $table = "covers";
  protected $fillable = ["image"];
	protected $dates = ["published_at"];

  public function book(){
    return $this->belongsTo("App\Book");
  }

}
