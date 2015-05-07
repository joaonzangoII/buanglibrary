<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {

  protected $table = 'bookings';
	protected $fillable = [
    "booker_id",
    "book_id",
    "amount",
    "num_booked",
    "start_date",
    "end_date",
  ];

  protected $dates = ["start_date","end_date"];

   public function users()
   {
        return $this->belongsToMany('App\User', 'bookings_users');
   }
}
