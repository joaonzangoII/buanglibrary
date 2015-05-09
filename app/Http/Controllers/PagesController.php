<?php namespace App\Http\Controllers;
use App\Book;
class PagesController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$books = Book::with("cover")->paginate(10);
		return view('site.pages.index',compact("books"));
	}
  public function test()
	{
		$books = Book::with("cover")->paginate(10);
		return view('site.pages.test',compact("books"));
	}
	public function about_us()
	{
		return view('site.pages.about');
	}

	public function contact_us()
	{
		return view('site.pages.contact');
	}

}
