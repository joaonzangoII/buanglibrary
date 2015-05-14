<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book;
use App\BookCategory;
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
    // $books = \DB::select("select *from books");
    // $book_categories = \DB::select("select *from book_categories");  
    $books = Book::latest()->take(10)->get();
    // $book_categories = BookCategory::all();
    $book_categories_list  = BookCategory::lists("name");
    $book_categories  = BookCategory::with("books")->get();
    $books_count  = [];
    foreach ($book_categories as $key => $value) {
      $books_count[] = $value->books->count();
    }
    return view ("admin.pages.index",compact('books','book_categories_list','books_count'));
  }
  public function forbidden()
	{
		return view ("admin.pages.forbidden");
	}
}
