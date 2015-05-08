<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Book;
class SearchController extends Controller {
  
  public function search(Request $request){
    $query =$request->input('query');
    // dd($query);
    $search_values = array();
    $search_values= Book::with('book_category')->like('title',$query)
                                             ->latest()->paginate(10);                                
    $total=$search_values->toArray()["total"];

    return view("site.pages.search",compact("query","total","search_values"));

  }

}
