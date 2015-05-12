<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Type;
use App\User;
use \Auth as Auth;
use \Session as Session;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;

class AdminUsersController extends Controller {

	public function __construct()
  {
    \Debugbar::enable();
  	$this->middleware('auth',['except' => 'store']);
		$emp_keys = array();
		// $emp_keys = Type::oldest("name")->lists("name","name");
		// dd(\Auth::User());
		if(!\Auth::guest())
			if(\Auth::User()->hasPermission("create_admin")==true)
	    {
				$emp_keys = ["admin" =>"admin","lecturer" =>"lecturer","student"=>"student"];
		  }
		  else{
		  	$emp_keys = ["lecturer" =>"lecturer","student"=>"student"];
		  }

		view()->share(compact("emp_keys"));
  }
	public function index()
	{
		if(!Auth::User()->isAdmin()){
			return redirect()->route("admin.forbidden");
		}
		// $users = \DB::select("select *from users");
		$users = User::with("books")->with("permissions")->paginate(10);
		return view("admin.pages.users.index",compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!Auth::User()->isAdmin()){
			return redirect()->route("admin.forbidden");
		}
		return view ("admin.pages.users.create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UsersRequest $request)
	{
		$user = User::create($request->all());
		$user->makeEmployee($request->input("user_type"));
		// $this->auth->login($this->registrar->create($request->all()));
		return redirect()->route('admin.users.index')->with('flash_notice', 'New user created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(User $user)
	{
		return view ("admin.pages.users.show",compact("user"));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(User $user)
	{
		if(!Auth::User()->isAdmin()){
			return redirect()->route("admin.forbidden");
		}
		return view ("admin.pages.users.edit",compact("user"));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UsersRequest $request,User $user)
	{
		// dd("here");
		$data=$request->all();
		$user->update($data);
		return redirect()->route("admin.users.index")->with('flash_notice', 'A user has been updated');
  }
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(User $user)
	{
		 $user->delete();
		 Session::flash('flash_notice', 'Successfully deleted the user!');
		 return redirect()->route("admin.users.index");
	}

}
