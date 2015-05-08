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
		// $books = \DB::select("select *from books");
		$books = Book::with("cover")->with("book_category")->paginate(10);
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
    if($book->cover!=null){
	    if (!\File::delete(public_path(). "/images/uploads/". $book->cover->image))
			{
				Session::flash('flash_notice', 'ERROR deleteing the File!');
				return redirect()->route("admin.books.index");
			}
	  }
    // dd($book->cover->image);
		$book->delete();
		Session::flash('flash_notice', 'Successfully deleted the book!');
		return redirect()->route("admin.books.index");
	}

	public function getBooking(Book $book)
	{  
		$book_keys = Book::lists("name","id");
    return view('admin.pages.books.booking',compact("book","book_keys"));
	}

	public function postBooking(BookingsRequest $request)
	{   
	  $user = Auth::User();
	  $data = $request->all();
	  if(!array_key_exists("booker_id" ,$data)){
	  	return redirect()->back()->withInput()->withErrors('cannot book now');
	  }
	  $book = Book::find($data["book_id"]);
	  $data["booker_id"] = $user->id;
	  $start_date = new Carbon($data["start_date"]);
	  $end_date = new Carbon($data["end_date"]);
	  $num_days = $start_date->diff($end_date)->days;

	  if($end_date < $start_date){
	  	return redirect()->back()->withInput()->withErrors('start date must not be after end date');
	  }
	  $num_days = $start_date->diff($end_date)->days;
		if($num_days <=  0)
		{
			return redirect()->back()->withInput()->withErrors('start date and end date must not be the same');
		}
		if(!$book->avail_books >= $data["num_booked"]){
	  	return redirect()->back()->withInput()->withErrors('There are not enough books available');
	  }

	  $amount = ($num_days * $book->price) * $data["num_booked"] ;
	  $data["amount"] = $amount;

		$booking = Booking::create($data);
    $user->bookings()->attach($booking);
		$booking->book()->attach($book);
    $book->decrement("avail_books",$data["num_booked"]);
    $book->save();
		Session::flash('flash_notice', 'Successfully booked this book!');
    return redirect()->route("admin.bookings.index");
	}

}
