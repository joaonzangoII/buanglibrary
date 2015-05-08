<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Type;
use App\User;
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
		return view ("admin.pages.users.create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UsersRequest $request)
	{
		// \DB::insert('insert into users (fname,lname,address,email,phone) values (?,?,?,?,?)', array(
		// 	          $request->input("fname"),
		// 	          $request->input("lname"),
		// 	          $request->input("address"),
		// 	          $request->input("email"),
		// 	          $request->input("phone")
		// 					 ));
		$user = User::create($request->all());
		$user->makeEmployee($request->input("user_type"));
		return redirect()->route('admin.users.index')->with('flash_notice', 'New category created');
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
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
