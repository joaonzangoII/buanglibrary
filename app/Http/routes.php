<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@index');
Route::get('about-us', 'PagesController@about_us');
Route::get('contact-us', 'PagesController@contact_us');
Route::get('/search',array('as' => 'procurar','uses' => "SearchController@search"));
Route::get('/book/booking',["uses"=>"BooksController@book", "as" =>"book.booking"]);
Route::get('/book/{books}',"BooksController@index");

Route::get('admin', 'AdminController@index');
Route::get('admin/books/booking/{books}', array("uses" => 'AdminBooksController@getBooking', "as" =>"admin.getBooking"));
Route::post('admin/books/booking', array("uses" => 'AdminBooksController@postBooking', "as" =>"admin.postBooking"));
Route::resource('admin/books', 'AdminBooksController');
Route::resource('admin/categories', 'AdminCategoriesController');
Route::resource('admin/users', 'AdminUsersController');
Route::resource('admin/bookings', 'AdminBookingsController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

$dispatcher = $this->app['events'];
Event::listen('eloquent.*', function(){
    $event = Event::firing();
    Debugbar::info("Received event: ". $event);
});
