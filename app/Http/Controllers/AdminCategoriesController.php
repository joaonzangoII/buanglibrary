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
use Anam\Phpcart\Cart;
class AdminCategoriesController extends Controller {

	public function __construct()
	{
		$cart = new Cart();
		\Debugbar::enable();
		$this->middleware('auth');
    $category_keys = BookCategory::oldest("name")->lists("name","id");
    $categories = BookCategory::with("books")->get();
    view()->share(compact("categories","category_keys","cart"));
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
	public function show(Request $request,BookCategory $book_category)
	{
		// $books = $book_category->books()->paginate(10);
		// $request
		if($request->has("search"))
		{
			// dd($request->input("title"));
			// $books=$book_category->books()->with("user","cover","book_category")->freesearch($request->input("title"),$request->input("author"),$request->input("edition"))->paginate(10);

			$books=$book_category->books()->with("user","cover","book_category")
			                     // ->where('book_category_id',$book_category->id)
			                     ->where('title','like','%'.$request->input("title").'%')
			                     ->orWhere('author','like','%'.$request->input("author").'%')
			                     ->orWhere('edition','like','%'.$request->input("edition").'%')
			                     ->paginate(10);
			// dd($books);
		}
		else{			
		 $books=$book_category->books()->with("user","cover","book_category")->paginate(10);
		}

		if($request->has("ord"))
		{
			// dd($request->input("ord"));
			if($request->input("ord")==="title"){
				$books = $book_category->books()->with("user","cover","book_category")->oldest("title")->paginate(10);
			}
			elseif($request->input("ord")==="-title")
			{
				$books = $book_category->books()->with("user","cover","book_category")->latest("title")->paginate(10);
			}

			if($request->input("ord")==="isbn"){
				$books = $book_category->books()->with("user","cover","book_category")->oldest("isbn")->paginate(10);
			}
			elseif($request->input("ord")==="-isbn")
			{
				$books = $book_category->books()->with("user","cover","book_category")->latest("isbn")->paginate(10);
			}

      if($request->input("ord")==="author"){
      	$books = $book_category->books()->with("user","cover","book_category")->oldest("author")->paginate(10);
      }
      elseif($request->input("ord")==="-author")
      {
      	$books = $book_category->books()->with("user","cover","book_category")->latest("author")->paginate(10);
      }

			if($request->input("ord")==="price"){
				$books = $book_category->books()->with("user","cover","book_category")->oldest("price")->paginate(10);
			}
			elseif($request->input("ord")==="-price")
			{
				$books = $book_category->books()->with("user","cover","book_category")->latest("price")->paginate(10);
			}

			if($request->input("ord")==="avail_books"){
				$books = $book_category->books()->with("user","cover","book_category")->oldest("avail_books")->paginate(10);
			}
			elseif($request->input("ord")==="-avail_books")
			{
				$books = $book_category->books()->with("user","cover","book_category")->latest("avail_books")->paginate(10);
			}

			if($request->input("ord")==="total_num_books"){
				$books = $book_category->books()->with("user","cover","book_category")->oldest("total_num_books")->paginate(10);
			}
			elseif($request->input("ord")==="-total_num_books")
			{
				$books = $book_category->books()->with("user","cover","book_category")->latest("total_num_books")->paginate(10);
			}
		}
		return view("admin.pages.categories.show",compact('book_category',"books"));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($book_category)
	{
		if(!Auth::User()->isAdmin()){
			return redirect()->route("admin.forbidden");
		}
    return view("admin.pages.categories.edit",compact('book_category',"books"));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(BookCategoriesRequest $request, BookCategory $book_category)
	{
		$data=$request->all();
		$book_category->update($data);
		return redirect()->route("admin.categories.index")->with('flash_notice', 'A book category has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($book_category)
	{
		// dd($book_category->books);
		$book_category->delete();
		return redirect()->route("admin.categories.index")->with('flash_notice', 'A book category has been deleted');
	}

}
