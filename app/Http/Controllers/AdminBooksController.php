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
use App\Cover;
use App\BookCategory;
use App\Booking;
use Carbon\Carbon;
use App\Http\Requests\BooksRequest;
use App\Http\Requests\BookingsRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class AdminBooksController extends Controller {

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
	public function index(Request $request)
	{
		// $request
		if($request->has("search"))
		{
			// dd($request->input("title"));
			$books=Book::with("user","cover","book_category")->freesearch($request->input("title"),$request->input("author"))->paginate(10);
			// dd($books);
		}
		else{			
		 $books=Book::with("user","cover","book_category")->paginate(10);
		}

		if($request->has("ord"))
		{
			// dd($request->input("ord"));
			if($request->input("ord")==="title"){
				$books = Book::with("user","cover","book_category")->oldest("title")->paginate(10);
			}
			elseif($request->input("ord")==="-title")
			{
				$books = Book::with("user","cover","book_category")->latest("title")->paginate(10);
			}

			if($request->input("ord")==="isbn"){
				$books = Book::with("user","cover","book_category")->oldest("isbn")->paginate(10);
			}
			elseif($request->input("ord")==="-isbn")
			{
				$books = Book::with("user","cover","book_category")->latest("isbn")->paginate(10);
			}

      if($request->input("ord")==="author"){
      	$books = Book::with("user","cover","book_category")->oldest("author")->paginate(10);
      }
      elseif($request->input("ord")==="-author")
      {
      	$books = Book::with("user","cover","book_category")->latest("author")->paginate(10);
      }

			if($request->input("ord")==="price"){
				$books = Book::with("user","cover","book_category")->oldest("price")->paginate(10);
			}
			elseif($request->input("ord")==="-price")
			{
				$books = Book::with("user","cover","book_category")->latest("price")->paginate(10);
			}

			if($request->input("ord")==="avail_books"){
				$books = Book::with("user","cover","book_category")->oldest("avail_books")->paginate(10);
			}
			elseif($request->input("ord")==="-avail_books")
			{
				$books = Book::with("user","cover","book_category")->latest("avail_books")->paginate(10);
			}

			if($request->input("ord")==="total_num_books"){
				$books = Book::with("user","cover","book_category")->oldest("total_num_books")->paginate(10);
			}
			elseif($request->input("ord")==="-total_num_books")
			{
				$books = Book::with("user","cover","book_category")->latest("total_num_books")->paginate(10);
			}

			
			// $books=Book::with("user","cover","book_category")->freesearch($request->input("title"),$request->input("author"))->paginate(10);
			// dd($books);
		}
		// else{			
		//  $books=Book::with("user","cover","book_category")->paginate(10);
		// }
		// $filter = \DataFilter::source(Book::with("user","cover","book_category"));
		// $filter->add('title','Title', 'text');
		// $filter->add('author','Author', 'text');
		// $filter->add('edition','Edition', 'text');
		// $filter->submit('search');
		// $filter->reset('reset');
		// $filter->build();

		// $grid = \DataGrid::source($filter);  //same source types of DataSet
		// $grid->add('title','Title', true); //field name, label, sortable
		// $grid->add('author','Author'); 
		// $grid->add('edition','Edition', true); //field name, label, sortable
		// $grid->add('isbn','Isbn', true); //field name, label, sortable
		// $grid->add('total_num_books','Total # books',true); //field name, label, sortable
		// $grid->add('avail_books','Avail Books',true); //field name, label, sortable
		// $grid->add('year','Year',true); //field name, label, sortable
		// $grid->add('price','Price Per Book',true); //field name, label, sortable
		// $grid->add('{{ $book_category->name }}','Category', 'book_category_id');
		// $grid->add('{{ $user->fullname }}','Added by', 'user_id');
		// if(Auth::User()->isAdmin()){
		// 	$grid->link(route("admin.books.create"),"Add New", "TR");  //add button
		// 	$grid->edit("/admin/books/action", 'Edit','show|modify|delete'); //shortcut to link DataEdit actions
		// }
		// else
		// {			
		// 	$grid->edit("/admin/books/action", 'Edit','show'); //shortcut to link DataEdit actions
		// }
		// $grid->orderBy('id','desc'); //default orderby
		// $grid->paginate(10); //pagination

		// $grid->row(function ($row) {
		// 	if ($row->cell('avail_books')->value == 20) {
		// 	$row->style("background-color:#CCFF66");
		// 	} elseif ($row->cell('avail_books')->value < 5) {
		// 	$row->cell('title')->style("font-weight:bold");
		// 	$row->style("color:#f00");
		// 	}
		// });
		// return view('admin.pages.books.index', compact('grid','filter'));
		return view('admin.pages.books.index', compact('books'));
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
		return view ("admin.pages.books.create",compact("categoria_keys"));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(BooksRequest $request)
	{
		$book = new Book($request->all());
		$book->avail_books = $book->total_num_books;
		$book = Auth::user()->books()->save($book);
		$file = array('image' => $request->file('image'));

    $imageName = $book->id . '.' . 
        $request->file('image')->getClientOriginalExtension();

    $request->file('image')->move(
        base_path() . '/public/images/uploads/', $imageName
    );
    $image = $request->all();
		$image["image"] = $imageName;
    $imagem = Cover::create($image);
		$book->cover()->save($imagem);		
		return redirect()->route('admin.books.index')->with('flash_notice', 'New Book created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Book $book)
	{
		return view('admin.pages.books.show',compact("categories","book"));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request,Book $book)
	{
    return view('admin.pages.books.edit',compact("categories","book"));
	}
	public function getAction(Request $request)
	{
		  if ($request->has('show')){
			  $id = $request->input("show");
			  $type = "show";
			}elseif($request->has('modify')){
				 $id = $request->input("modify");
				 $type = "modify";
			}else{
				$id = $request->input("delete");
				$type = "delete";
			}
		  $book = Book::find($id);
   
		  if(is_null($book)){
		  	return abort("404");
	  	}

	  	if($type==="show"){
       return view('admin.pages.books.show',compact("categories","book"));
	  	}
	  	elseif($type==="modify"){	
	  		if(!Auth::User()->isAdmin()){
	  			return redirect()->route("admin.forbidden");
	  		}
				return view('admin.pages.books.edit',compact("categories","book"));
	  	}
	  	else
	  	{
	  		if(!Auth::User()->isAdmin()){
	  			return redirect()->route("admin.forbidden");
	  		}
	      if($book->cover!=null){
	  	    if (!\File::delete(public_path(). "/images/uploads/". $book->cover->image))
	  			{
	  				Session::flash('flash_notice', 'ERROR deleting the File!');
	  				return redirect()->route("admin.books.index");
	  			}
	  	  }
	      // dd($book->cover->image);
	      $booking = Booking::where("book_id",$book->id)->delete();
	  		$book->delete();
	  		Session::flash('flash_notice', 'Successfully deleted the book!');
	  		return redirect()->route("admin.books.index");
	  	}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(BooksRequest $request,Book $book)
	{
		// dd("here");
	  $data=$request->all();
    $book->update($data);
		return redirect()->route("admin.books.index")->with('flash_notice', 'A book has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Book $book)
	{   
    if($book->cover!=null){
	    if (!\File::delete(public_path(). "/images/uploads/". $book->cover->image))
			{
				Session::flash('flash_notice', 'ERROR deleting the File!');
				return redirect()->route("admin.books.index");
			}
	  }
    // dd($book->cover->image);
    $booking = Booking::where("book_id",$book->id)->delete();
		$book->delete();
		Session::flash('flash_notice', 'Successfully deleted the book!');
		return redirect()->route("admin.books.index");
	}
}
