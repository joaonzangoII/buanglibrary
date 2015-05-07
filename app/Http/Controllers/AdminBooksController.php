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
use App\Category;
use App\Http\Requests\BooksRequest;
use App\Http\Requests\BookingsRequest;
class AdminBooksController extends Controller {

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
		// $books = \DB::select("select *from books");
		$books = Book::with("cover")->paginate(10);
		return view ("admin.pages.books.index",compact('books'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
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
    // dd(public_path(). "/images/uploads/". $book->cover->image)/0;
    if (!\File::delete(public_path(). "/images/uploads/". $book->cover->image))
		{
			Session::flash('flash_notice', 'ERROR deleteing the File!');
			return redirect()->route("admin.books.index");
		}
    // dd($book->cover->image);
		$book->delete();
		Session::flash('flash_notice', 'Successfully deleted the book!');
		return redirect()->route("admin.books.index");
	}

	public function getBooking(Book $book)
	{   
    return view('admin.pages.books.booking');
	}

	public function postBooking(BookingsRequest $request,Book $book)
	{   
		dd($book);
		Session::flash('flash_notice', 'Successfully booked this book!');
    return redirect()->route("admin.getBooking");
	}

}