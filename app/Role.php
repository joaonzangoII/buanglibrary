<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model{
    protected $table = 'roles';
    /**
     * Set timestamps off
     */
    public $timestamps = false;

    /**
     * Get users with a certain role
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'users_roles');
    }
}
