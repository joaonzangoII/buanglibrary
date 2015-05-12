<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Booking;
use Carbon\Carbon;
use \Auth as Auth;
use \Session as Session;
use App\Http\Requests\BookingsRequest;
class AdminBookingsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$book_keys = Book::lists("title","id");
    view()->share(compact("book_keys"));
	}
	public function index()
	{
		if(Auth::guest()){
			return redirect("/auth/login");
		}
		if(Auth::User()->isAdmin())
		{
			$bookings = Booking::paginate(10);
		}
		else
		{	
		  // $bookings = Booking::paginate(10);		
			$bookings = \Auth::User()->bookings()->paginate(10);
		}
		return view ("admin.pages.bookings.index",compact('bookings'));
	}

	public function booking(Book $book){
    redirect()->route("");
  }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::guest()){
			return redirect("/auth/login");
		}
		if(!Auth::User()->isAdmin()){
			return redirect()->route("admin.forbidden");
		}
			$user_keys = User::whereIn("user_type",["lecturer","student"])->lists("fullname","id");
		return view ("admin.pages.bookings.create",compact("book_keys","user_keys"));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(BookingsRequest $request)
	{
	  $data = $request->all();
	  if(Book::all()->count()==0){
	  	return redirect()->back()->withInput()->withErrors('There are no books available');
	  }
	  $book = Book::find($data["book_id"]);
	  if(!array_key_exists("booker_id" ,$data)){
	  	return redirect()->back()->withInput()->withErrors('cannot book now');
	  }
		$user = User::find($data["booker_id"]);
	  $data["booker_id"] = $user->id;
	  $start_date = new Carbon($data["start_date"]);
	  $end_date = new Carbon($data["end_date"]);
	  // dd($data);
	  if($end_date < $start_date){
	  	return redirect()->back()->withInput()->withErrors('start date must not be after end date');
	  }

	  $num_days = $start_date->diff($end_date)->days;
	  // dd($num_days);
		if($num_days <=  0)
		{
			return redirect()->back()->withInput()->withErrors('start date and end date must not be the same');
		}

		if($data["num_booked"] > $book->avail_books ){
	  	return redirect()->back()->withInput()->withErrors('There are not enough books available');
	  }


	  $amount = ($num_days * $book->price) * $data["num_booked"] ;
	  $data["amount"] = $amount;
	  // dd($data);
		$booking = Booking::create($data);
		$user->bookings()->attach($booking);
		$booking->book()->attach($book);
    $book->decrement("avail_books",$data["num_booked"]);
    $book->save();
		Session::flash('flash_notice', 'Successfully booked this book!');
    return redirect()->route("admin.bookings.index");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Booking $booking)
	{
		return view("admin.pages.bookings.show",compact("booking"));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Booking $booking)
	{
		if(!Auth::User()->isAdmin()){
			return redirect()->route("admin.forbidden");
		}

		$user_keys = User::whereIn("user_type",["lecturer","student"])->lists("fullname","id");
		return view ("admin.pages.bookings.edit",compact("booking","book_keys","user_keys"));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Booking $booking)
	{
		dd($booking);
	}

	public function create_booking(Book $book)
	{  	
    return view('admin.pages.bookings.notadmin.one',compact("book","book_keys"));
	}
	public function create_any_booking(Book $book)
	{  
    return view('admin.pages.bookings.notadmin.any',compact("book","book_keys"));
	}

	public function store_booking(BookingsRequest $request)
	{   
	  $user = Auth::User();
	  $data = $request->all();
	  if(Book::all()->count()==0){
	  	return redirect()->back()->withInput()->withErrors('There are no books available');
	  }
	  $book = Book::find($data["book_id"]);
	  if(!array_key_exists("booker_id" ,$data)){
	  	return redirect()->back()->withInput()->withErrors('cannot book now');
	  }
	  $data["booker_id"] = $user->id;
	  $start_date = new Carbon($data["start_date"]);
	  $end_date = new Carbon($data["end_date"]);
	  $num_days = $start_date->diff($end_date)->days;
    
    if($data["num_booked"]<=0){
  	  // dd($book->avail_books >= $data["num_booked"]);
    	return redirect()->back()->withInput()->withErrors('You cannot book zero or negative boooks');
    }
	  if($data["num_booked"]> $book->avail_books){
		  // dd($book->avail_books >= $data["num_booked"]);
	  	return redirect()->back()->withInput()->withErrors('There are not enough books available');
	  }

	  if($end_date < $start_date){
	  	return redirect()->back()->withInput()->withErrors('start date must not be after end date');
	  }
	  $num_days = $start_date->diff($end_date)->days;
		if($num_days <=  0)
		{
			return redirect()->back()->withInput()->withErrors('start date and end date must not be the same');
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

			/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Booking $booking)
	{
		$book = $booking->book;
		$book[0]->increment("avail_books",$booking->num_booked);
		$booking->delete();
		Session::flash('flash_notice', 'Successfully deleted the booking');
		return redirect()->route("admin.bookings.index");
	}
}
