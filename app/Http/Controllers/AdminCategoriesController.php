<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use \Str as Str;
use \Auth as Auth;
use \Session as Session;
use \Validator as Validator;
use App\Book;
use App\Category;
use App\Http\Requests\CategoriesRequest;
class AdminCategoriesController extends Controller {

	public function __construct()
	{
		\Debugbar::enable();
		$this->middleware('auth');
    $category_keys = Category::oldest("name")->lists("name","id");
    $categories = Category::with("books")->get();
    view()->share(compact("categories","category_keys"));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = \DB::select("select *from categories");
		$categories = Category::with("books")->paginate(10);
		return view("admin.pages.categories.index",compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view ("admin.pages.categories.create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CategoriesRequest $request)
	{
		\DB::insert('insert into categories (name) values (?)', array($request->input('name')));

		return redirect()->route('admin.categories.index')->with('flash_notice', 'New category created');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
