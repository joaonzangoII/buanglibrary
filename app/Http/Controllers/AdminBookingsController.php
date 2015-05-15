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
			$user_keys = User::whereIn("user_type",["user"])->lists("fullname","id");
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
		$start_date = new Carbon($data["start_date"]);
	  $end_date = new Carbon($data["end_date"]);
		if($start_date < Date("Y-m-d")){
	  	return redirect()->back()->withInput()->withErrors('start date cannot be prior to todays date');
	  }
	  if(Book::all()->count()==0){
	  	return redirect()->back()->withInput()->withErrors('There are no books available');
	  }
	  $book = Book::find($data["book_id"]);
	  if(!array_key_exists("booker_id" ,$data)){
	  	return redirect()->back()->withInput()->withErrors('cannot book now');
	  }
		$user = User::find($data["booker_id"]);
	  $data["booker_id"] = $user->id;

	  $data["booking_number"] = $this->booking_number();

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
	  $discount = 0;
	  if($user->isLecturer()){
     $discount = $amount * 0.1;
     $data["has_discount"]	= "Y";
	  }else{
	  	$data["has_discount"]	= "N";
	  }
	  $data["amount"] = $amount - $discount;
	  $data["state"] = "pending";

	  $duplicate= $this->find_duplicate($data["booker_id"],$data["book_id"],$data["start_date"],$data["end_date"]);
	  // dd($duplicate->isEmpty());
	  if($duplicate->isEmpty()==false)
	  {
     	return redirect()->back()->withInput()->withErrors('You cannot book this book again');
	  }
		$booking = Booking::create($data);
		$user->bookings()->attach($booking);
		$booking->book()->attach($book);
    $book->decrement("avail_books",$data["num_booked"]);
    $book->save();
    
    $send_data =["user" => $user,"book" => $book,"booking" => $booking ];
    // return view("admin.pages.bookings.partials._email",compact("send_data"));
    \Mail::send("emails.booking", $send_data, function($message) use ($send_data)
    {
      $message->to($send_data["user"]->email, 'Buang Library')->subject('Booking');
    });
		Session::flash('flash_notice', 'Successfully booked this book!');
    return redirect()->route("admin.bookings.index");
	}

	public function find_duplicate($booker_id,$book_id, $start_date,$end_date){
	  $booking = Booking::where("booker_id",$booker_id)
							        ->where("book_id",$book_id)
							        ->where("start_date",$start_date)
							        ->where("end_date",$end_date)->get();
   return $booking;
	}
 public function booking_number(){

 	if(count(\DB::select("select id from booking_sequences where date = CURDATE()"))==0){
    $sequence = 0;
 	}else{
    // $sequence = \DB::select("select id from booking_sequences where date = CURDATE()");?
    $sequence = \DB::table('booking_sequences')->where('date', date("Y-m-d"))->pluck('id');
    // dd($sequence);
 	}
	$sequence = $sequence + 1;
  // dd($sequence);

	$code = "BK";
	$b_number = $code . date("ymd") . str_pad($sequence, 4, '0', STR_PAD_LEFT);
  \DB::statement("insert into booking_sequences set id = $sequence, date = CURDATE() ON DUPLICATE KEY UPDATE id = $sequence");
 	return $b_number;
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
    $state_keys = ["pending"=> "pending","collected"=>"collected","cancelled"=>"cancelled"];
		$user_keys = User::whereIn("user_type",["user"])->lists("fullname","id");
		return view ("admin.pages.bookings.edit",compact("booking","book_keys","user_keys","state_keys"));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(BookingsRequest $request,Booking $booking)
	{
	  $data = $request->all();
		$start_date = new Carbon($data["start_date"]);
	  $end_date = new Carbon($data["end_date"]);
		if($start_date < Date("Y-m-d")){
	  	return redirect()->back()->withInput()->withErrors('start date cannot be prior to todays date');
	  }
	  $user = User::find($data["booker_id"]);
	  // $data["booking_number"] = $this->booking_number();
	  if(Book::all()->count()==0){
	  	return redirect()->back()->withInput()->withErrors('There are no books available');
	  }
	  $book = Book::find($data["book_id"]);
	  $book->increment("avail_books",$booking->num_booked);
	  $book->save(); 

	  $data["booker_id"] = $user->id;
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
    $discount = 0;
	  if($user->isLecturer()){
     $discount = $amount * 0.1;
     $data["has_discount"]	= "Y";
	  }
	  else{
	  	$data["has_discount"]	= "N";
	  }
	  $data["amount"] = $amount - $discount;

		$booking->update($data);

		// dd($booking);

		// $user->bookings()->attach($booking);
		// $booking->book()->attach($book);
    $book->decrement("avail_books",$data["num_booked"]);
    $book->save(); 
    $send_data =["user" => $user,"book" => $book,"booking" => $booking];

    \Mail::send("emails.booking", $send_data, function($message) use ($send_data)
    {
      $message->to($send_data["user"]->email, 'Buang Library')->subject('Booking');
    });
		return redirect()->route("admin.bookings.index")->with('flash_notice', 'A booking has been updated');
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
	  $data = $request->all();
		$start_date = new Carbon($data["start_date"]);
	  $end_date = new Carbon($data["end_date"]);
		if($start_date < Date("Y-m-d")){
	  	return redirect()->back()->withInput()->withErrors('start date cannot be prior to todays date');
	  }
	  $user = Auth::User();
	  $data["booking_number"] = $this->booking_number();
	  if(Book::all()->count()==0){
	  	return redirect()->back()->withInput()->withErrors('There are no books available');
	  }
	  $book = Book::find($data["book_id"]);
	  // if(Auth::isAdmin())["pending","cancelled","collected"]
	  // }
	  $data["booker_id"] = $user->id;
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
    $discount = 0;
	  if($user->isLecturer()){
     $discount = $amount * 0.1;
     $data["has_discount"]	= "Y";
	  }
	  else{
	  	$data["has_discount"]	= "N";
	  }
	  $data["amount"] = $amount - $discount;
	  $data["state"] = "pending";

	  $duplicate= $this->find_duplicate($data["booker_id"],$data["book_id"],$data["start_date"],$data["end_date"]);
	  if($duplicate->isEmpty()==false)
	  {
     	return redirect()->back()->withInput()->withErrors('You cannot book this book again');
	  }
		$booking = Booking::create($data);
		$user->bookings()->attach($booking);
		$booking->book()->attach($book);
    $book->decrement("avail_books",$data["num_booked"]);
    $book->save(); 
    $send_data =["user" => $user,"book" => $book,"booking" => $booking ];

    \Mail::send("emails.booking", $send_data, function($message) use ($send_data)
    {
      $message->to($send_data["user"]->email, 'Buang Library')->subject('Booking');
    });

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
