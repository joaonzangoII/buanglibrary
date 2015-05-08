<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Booking;
use Carbon\Carbon;
use \Session as Session;
use App\Http\Requests\BookingsRequest;
class AdminBookingsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(\Auth::User()->isAdmin())
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
		$book_keys = Book::lists("name","id");
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
		$user = User::find($data["booker_id"]);
	  $book = Book::find($data["book_id"]);
	  $data["booker_id"] = $user->id;
	  $start_date = new Carbon($data["start_date"]);
	  $end_date = new Carbon($data["end_date"]);

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
	public function show()
	{
		
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
