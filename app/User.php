<?php namespace App;
use Carbon\Carbon;
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
	protected $fillable = ['fullname','fname',"lname", 'email', 'password',"phone","address","user_type","id_number"];

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
     * Get the permissions a user has
     */
  public function type()
  {
      return $this->belongsTo('App\UserType');
  }

  public function permissions()
  {
      return $this->belongsToMany('App\Permission', 'users_permissions');
  }

	public function books(){
		return $this->hasMany("App\Book");
	}
  public function bookings()
  {
    return $this->belongsToMany('App\Booking', 'bookings_users');
  }
  /**
     * Find out if User is an employee, based on if has any permissions
     *
     * @return boolean
     */
    public function isEmployee()
    {
        $permissions = $this->permissions->toArray();
        return !empty($permissions);
    }

    public function isLecturer()
    {
      return $this->user_type === "lecturer";
    }

    public function setPasswordAttribute($pass){
      $this->attributes['password'] = bcrypt($pass);
    }

    /**
     * Find out if user has a specific role
     *
     * $return boolean
     */
    public function hasPermission($check)
    {
        return in_array($check, array_fetch($this->permissions->toArray(), 'name'));
    }

    public function isAdmin()
    {
        return $this->user_type === "admin" || $this->user_type ==="super_admin";
    }

    public function date_of_birth()
    {
      $year = substr($this->id_number,0, 2);
      $currentYear =  date("Y") % 100;
      // dd($currentYear);
      $prefix = "19";
     
      if (+$year < $currentYear)
        $prefix = "20";
      // dd( $prefix);
      $month = substr($this->id_number,2, 2);
      $day = substr($this->id_number,4, 2);
      // dd($day);
      return ($prefix . $year . "-" . $month . "-" . $day);
    }

    public function gender()
    {
      return +substr($this->id_number,6, 1) < 5 ? "female" : "male";
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
     * Add permissions to user to make them a concierge
     */
    public function addPermissions($title)
    {
        $assigned_permissions = array();
        $permissions = array_fetch(\App\Permission::all()->toArray(), 'name');
        switch ($title) {
            case "super_admin":
              $assigned_permissions[] = $this->getIdInArray($permissions, 'create_admin');
              $assigned_permissions[] = $this->getIdInArray($permissions, 'create_book');
              $assigned_permissions[] = $this->getIdInArray($permissions, 'view_book');
              $assigned_permissions[] = $this->getIdInArray($permissions, 'edit_book');
              $assigned_permissions[] = $this->getIdInArray($permissions, 'delete_book');

              $assigned_permissions[] = $this->getIdInArray($permissions, 'create_user');
              $assigned_permissions[] = $this->getIdInArray($permissions, 'view_user');
              $assigned_permissions[] = $this->getIdInArray($permissions, 'edit_user');
              $assigned_permissions[] = $this->getIdInArray($permissions, 'delete_user');
              break;
            case 'admin':
                $assigned_permissions[] = $this->getIdInArray($permissions, 'create_book');
                $assigned_permissions[] = $this->getIdInArray($permissions, 'view_book');
                $assigned_permissions[] = $this->getIdInArray($permissions, 'edit_book');
                $assigned_permissions[] = $this->getIdInArray($permissions, 'delete_book');

                $assigned_permissions[] = $this->getIdInArray($permissions, 'create_user');
                $assigned_permissions[] = $this->getIdInArray($permissions, 'view_user');
                $assigned_permissions[] = $this->getIdInArray($permissions, 'edit_user');
                $assigned_permissions[] = $this->getIdInArray($permissions, 'delete_user');
                break;
            case 'user':
              $assigned_permissions[] = $this->getIdInArray($permissions, 'view_book');
              $assigned_permissions[] = $this->getIdInArray($permissions, 'book_a_book');
              break;
            default:
                // throw new \Exception("The employee status entered does not exist");
        }
        // dd($assigned_permissions);
        $this->permissions()->attach($assigned_permissions);
    }
}
