<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {

	protected $table = 'bookings';

   public function users()
   {
        return $this->belongsToMany('App\User', 'bookings_users');
   }
}
