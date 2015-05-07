<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['fullname','fname',"lname", 'email', 'password',"phone","address","user_type"];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function setFullnameAttribute()
	{
		$this->attributes["fullname"] = $this->attributes["fname"] . " " . $this->attributes["lname"];
	}

	/**
     * Get the roles a user has
     */
  public function type()
  {
      return $this->belongsTo('App\Type');
  }

  public function roles()
  {
      return $this->belongsToMany('App\Role', 'users_roles');
  }

	public function books(){
		return $this->hasMany("App\Book");
	}
  public function bookings()
  {
    return $this->belongsToMany('App\Booking', 'bookings_users');
  }
  /**
     * Find out if User is an employee, based on if has any roles
     *
     * @return boolean
     */
    public function isEmployee()
    {
        $roles = $this->roles->toArray();
        return !empty($roles);
    }

    public function setPasswordAttribute($pass){
      $this->attributes['password'] = bcrypt($pass);
    }

    /**
     * Find out if user has a specific role
     *
     * $return boolean
     */
    public function hasRole($check)
    {
        return in_array($check, array_fetch($this->roles->toArray(), 'name'));
    }

    public function isAdmin()
    {
        return $this->user_type === "admin" || $this->user_type ==="super_admin";
    }
 
    /**
     * Get key in array with corresponding value
     *
     * @return int
     */
    private function getIdInArray($array, $term)
    {
        foreach ($array as $key => $value) {
            if ($value == $term) {
								echo $value . "<br>";
                return $key + 1;
            }
        }

        // throw new UnexpectedValueException;
    }

    /**
     * Add roles to user to make them a concierge
     */
    public function makeEmployee($title)
    {
        $assigned_roles = array();
        $roles = array_fetch(\App\Role::all()->toArray(), 'name');
        switch ($title) {
            case "super_admin":
              $assigned_roles[] = $this->getIdInArray($roles, 'create_admin');
              $assigned_roles[] = $this->getIdInArray($roles, 'create_book');
              $assigned_roles[] = $this->getIdInArray($roles, 'edit_book');
              $assigned_roles[] = $this->getIdInArray($roles, 'delete_book');
              $assigned_roles[] = $this->getIdInArray($roles, 'create_user');
              $assigned_roles[] = $this->getIdInArray($roles, 'edit_user');
              $assigned_roles[] = $this->getIdInArray($roles, 'delete_user');
              break;
            case 'student':
              $assigned_roles[] = $this->getIdInArray($roles, 'book_a_book');
              break;
            case 'admin':
                $assigned_roles[] = $this->getIdInArray($roles, 'create_book');
                $assigned_roles[] = $this->getIdInArray($roles, 'edit_book');
                $assigned_roles[] = $this->getIdInArray($roles, 'delete_book');
                $assigned_roles[] = $this->getIdInArray($roles, 'create_user');
                $assigned_roles[] = $this->getIdInArray($roles, 'edit_user');
                $assigned_roles[] = $this->getIdInArray($roles, 'delete_user');
                break;
            case 'lecturer':
                $assigned_roles[] = $this->getIdInArray($roles, 'book_a_book');
                $assigned_roles[] = $this->getIdInArray($roles, 'get_discount');
                break;
            default:
                // throw new \Exception("The employee status entered does not exist");
        }

        $this->roles()->attach($assigned_roles);
    }
		/**
		* Add roles to user to make them a concierge
		*/
		// public function setMakeEmployeeAttribute($title){
		//
		//
		// }

		// public function getRolesAttribute($value)
    // {
    //     return explode(', ', $value);
    // }
}
