<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Book;

class BooksController extends Controller {

	public function index(Book $book){
   return view("site.pages.books.index",compact("book"));
  }
  
  public function book(){
   
    $data = [
     "auth" => \Auth::Check()
    ];
    return \Response::json($data);
    // return view("site.pages.books.index",compact("book"));
  }
}
