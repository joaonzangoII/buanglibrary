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
use App\BookCategory;
use App\Http\Requests\BookCategoriesRequest;
class AdminCategoriesController extends Controller {

	public function __construct()
	{
		\Debugbar::enable();
		$this->middleware('auth');
    $category_keys = BookCategory::oldest("name")->lists("name","id");
    $categories = BookCategory::with("books")->get();
    view()->share(compact("categories","category_keys"));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = \DB::select("select *from book_categories");
		$categories = BookCategory::with("books")->paginate(10);
		return view("admin.pages.categories.index",compact('categories'));
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
		return view ("admin.pages.categories.create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(BookCategoriesRequest $request)
	{
		\DB::insert('insert into book_categories (name) values (?)', array($request->input('name')));

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
		// if(!Auth::User()->isAdmin()){
		// 	return redirect()->route("admin.forbidden");
		// }
	  return view ("admin.pages.categories.show");
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(!Auth::User()->isAdmin()){
			return redirect()->route("admin.forbidden");
		}
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
	public function destroy($book_category)
	{
		dd($book_category->books);
	}

}
