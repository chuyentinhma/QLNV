<?php

use Impl\Repo\Order\OrderInterface;

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
    protected $order;

//    protected $tag
    // Class expects an Eloquent model
    public function __construct(OrderInterface $order) {
        
        $this->order = $order;
    }

    public function dashBoard() {
        
        $today = \Carbon\Carbon::now()->format('Y-m-d');
        $yesterday = \Carbon\Carbon::yesterday()->format('Y-m-d');
        $tomorrow = \Carbon\Carbon::tomorrow()->format('Y-m-d');
        
        $totalToday = $this->order->countNewOrder($today, $tomorrow);
        $purposeToday = $this->order->countPurposesOrder($today, $tomorrow);
        
        $totalYesterday = $this->order->countNewOrder($yesterday, $today);
        $purposeYesterday = $this->order->countPurposesOrder($yesterday, $today);
        
        $unitYesterday = $this->order->countUnitOrder($yesterday, $today);
        $unitToday = $this->order->countUnitOrder($today, $tomorrow);
        
        return View::make('home.dashboard',  compact('unitToday','unitYesterday','purposeToday','purposeYesterday','totalToday','totalYesterday'));
    }

    public function error() {
        return View::make('home.error');
    }

    public function setupSystem() {
        return View::make('home.setup');
    }

}
