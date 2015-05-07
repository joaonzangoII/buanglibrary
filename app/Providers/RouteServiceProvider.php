<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		//
		
		parent::boot($router);

		$router->bind("books",function($slug){
			try {
				// dd($slug);
			  return \App\Book::whereSlug($slug)->firstOrFail();  //findOrfail($slug);
			} catch ( ModelNotFoundException $e ) {
			  return abort("404");
			}
		});

		$router->bind("users",function($id){
			try {
				// dd($id);
			  return \App\User::findOrfail($id);
			} catch ( ModelNotFoundException $e ) {
			  return abort("404");
			}
		});

	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
