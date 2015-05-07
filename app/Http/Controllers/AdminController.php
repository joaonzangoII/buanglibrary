<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller {

  public function __construct()
  {
    \Debugbar::enable();
  	$this->middleware('auth');
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    $books = \DB::select("select *from books");
		return view ("admin.pages.index",compact('books'));
	}
}
