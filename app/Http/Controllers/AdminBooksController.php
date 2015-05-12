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
	public function index()
	{
		$books = Book::with("cover")->with("book_category")->paginate(10);
		// \Response::json($books);
		// if(\Request::ajax()){
		// 	return view ("admin.pages.books.index",compact('books'));
		// }
		return view ("admin.pages.books.index",compact('books'));
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
	public function edit(Book $book)
	{
		if(!Auth::User()->isAdmin()){
			return redirect()->route("admin.forbidden");
		}
		return view('admin.pages.books.edit',compact("categories","book"));
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
