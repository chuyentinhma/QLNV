<?php

class HomeController extends BaseController {
//    protected $layout = 'layouts.layout';
    /*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function dashBoard()
	{
            return View::make('home.dashboard');
	}
        public function error() {
            return View::make('home.error');
        }
        

}
