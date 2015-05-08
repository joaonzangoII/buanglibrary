<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model{
    protected $table = 'permissions';
    /**
     * Set timestamps off
     */
    public $timestamps = false;

    /**
     * Get users with a certain role
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'users_permissions');
    }
}
