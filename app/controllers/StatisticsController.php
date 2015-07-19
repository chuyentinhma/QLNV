<?php

use Impl\Repo\Order\OrderInterface;

class StatisticsController extends \BaseController {

    protected $order;

    public function __construct(OrderInterface $order) {

        $this->order = $order;
    }

    public function index() {
        
        $dateStart = Carbon\Carbon::now()->format('Y-m-d');
        $dateEnd = Carbon\Carbon::tomorrow()->format('Y-m-d');
        if (Request::ajax()) {
            $dateStart = Carbon\Carbon::createFromFormat('d/m/Y', Input::get('dateStart'))->format('Y-m-d');
            $dateEnd = Carbon\Carbon::createFromFormat('d/m/Y', Input::get('dateEnd'))->format('Y-m-d');
        }
        $totalOrder = $this->order->countNewOrder($dateStart, $dateEnd);
        if(Request::ajax()) {
            return View::make('statistics.statistic')->with(array('dateStart' => $dateStart, 'dateEnd' => $dateEnd,
                    'totalOrder' => $totalOrder));
        }
            
        return View::make('statistics.index')->with(array('dateStart' => $dateStart, 'dateEnd' => $dateEnd,
                    'totalOrder' => $totalOrder));
    }

}
