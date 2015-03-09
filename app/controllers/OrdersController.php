<?php

use Impl\Repo\Order\OrderInterface;
use Impl\Service\Form\Order\OrderForm;
use Impl\Service\Validation\ValidationException;
use Impl\Repo\Unit\UnitInterface;
use Impl\Repo\Kind\KindInterface;
use Impl\Repo\Category\CategoryInterface;
use Impl\Repo\Purpose\PurposeInterface;
use Impl\Repo\User\UserInterface;

//use Illuminate\Support\Facades\View;

class OrdersController extends \BaseController {

    protected $order;
    protected $unit;
    protected $kind;
    protected $category;
    protected $purpose;
    protected $user;
    protected $orderForm;

    public function __construct(OrderInterface $order, UnitInterface $unit, KindInterface $kind, CategoryInterface $category, PurposeInterface $purpose, UserInterface $user, OrderForm $orderForm) {

        $this->order = $order;
        $this->unit = $unit;
        $this->kind = $kind;
        $this->category = $category;
        $this->purpose = $purpose;
        $this->user = $user;
        $this->orderForm = $orderForm;

        View::composer(['orders.create', 'orders.edit'], function ($view) {

            $units = $this->unit->formatData($this->unit->all());
            $kinds = $this->kind->formatData($this->kind->all());
            $categories = $this->category->formatData($this->category->all());
            $purposes = $this->purpose->formatData($this->purpose->all());
            $users = $this->user->formatData($this->user->all());

            $view->with(array('units' => $units,
                'kinds' => $kinds,
                'categories' => $categories,
                'purposes' => $purposes,
                'users' => $users
            ));
        });
    }

    /**
     * Display a listing of orders
     *
     * @return Response
     */
    public function index() {

        $page = Input::get('page', 1);
        // Candidate for config item
         $perPage = Input::get('perPage', 5);

        $pagiData = $this->order->byPage($page, $perPage, true);

        $orders = Paginator::make($pagiData->items, $pagiData->totalItems, $perPage);

        return View::make('orders.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new order
     *
     * @return Response
     */
    public function create() {

        return View::make('orders.create');
    }

    /**
     * Store a newly created order in storage.
     *
     * @return Response
     */
    public function store() {

        // Form processing
        try {

            $this->orderForm->create(Input::all());
            if (Input::get('redirect') == '1') {
//                // coutinue
                return Redirect::route('orders.add')->with('success', 'Tạo mới thành công 1 yêu cầu');
            }
            return Redirect::route('orders.index')->with('success', 'Tạo mới thành công 1 yêu cầu');
        } catch (ValidationException $ex) {

            return Redirect::back()->withInput()->withErrors($ex->getErrors());
        }
    }

    /**
     * Display the specified order.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {

        $order = $this->order->byId($id);

        return View::make('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {

        $order = $this->order->byId($id);

        return View::make('orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

        $input = array_merge(Input::all(), array('id' => $id));
        try {
            $this->orderForm->update($input);
        } catch (ValidationException $ex) {

            return Redirect::back()->withInput()->withErrors($ex->getErrors());
        }

        return Redirect::route('orders.index');
    }

    /**
     * Search the specified order in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function search() {
        $keyword = Input::get('keyword');
        $page = Input::get('page', 1);
        // Candidate for config item
        $perPage = Input::get('perPage', 5);
        $purpose = Input::get('purpose');
        $pagiData = $this->order->searchName($keyword, $purpose, $page, $perPage);
        $orders = Paginator::make($pagiData->items, $pagiData->totalItems, $perPage);
        
        return View::make('orders.search')->with(array('orders'=> $orders,'keyword' =>$keyword,'perPage' => $perPage, 'purpose' => $purpose));
    }

    /**
     * Remove the specified order from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        Order::destroy($id);

        return Redirect::back();
    }

}
