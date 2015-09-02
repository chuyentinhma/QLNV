<?php

use Impl\Service\Validation\ValidationException;
use Impl\Repo\ShipsList\ShipsListInterface;
use Impl\Service\Form\ShipsList\ShipsListForm;
use Impl\Repo\Order\OrderInterface;
use Impl\Repo\User\UserInterface;

class ShipsListsController extends \BaseController {

    protected $order;
    protected $user;
    protected $listForm;
    protected $shipsList;

    public function __construct(OrderInterface $order, UserInterface $user, ShipsListInterface $shipsList, ShipsListForm $listForm) {
        
        $this->order = $order;
        $this->user = $user;

        $this->shipsList = $shipsList;
        $this->listForm = $listForm;

        View::composer(['shipslists.create', 'shipslists.edit'], function ($view) {

            $orders = $this->order->all('list');
            $users = $this->user->formatData($this->user->all());

            $view->with(array(
                'orders' => $orders,
                'users' => $users
            ));
        });
    }

    /**
     * Display a listing of the resource.
     * GET /shipslists
     *
     * @return Response
     */
    public function index() {
        $page = Input::get('page', 1);
        // Candidate for config item
        $perPage = 3;

        $pagiData = $this->shipsList->byPage($page, $perPage, true);

        $lists = Paginator::make($pagiData->items, $pagiData->totalItems, $perPage);

        return View::make('shipslists.index')->with('lists', $lists);
    }

    /**
     * Show the form for creating a new resource.
     * GET /shipslists/create
     *
     * @return Response
     */
    public function create() {
        
        return View::make('shipslists.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /shipslists
     *
     * @return Response
     */
    public function store() {
        // Form processing
        try {
            $this->listForm->create(Input::all());
            if (Input::get('redirect') == '1') {
                // coutinue
                return Redirect::route('shipslists.create')->with('status', 'success');
            }
            return Redirect::route('shipslists.index')->with('status', 'success');
            
        } catch (ValidationException $ex) {
            if(is_array($ex->getErrors())) {
                return Redirect::back()->withInput()->withErrors($ex->getErrors());
            }
            return Redirect::back()->withInput()->with('error', $ex->getErrors());
        }
        
    }

    /**
     * Display the specified resource.
     * GET /shipslists/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /shipslists/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        
        $list = $this->shipsList->byId($id);

        return View::make('shipslists.edit', compact('list'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /shipslists/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $input = array_merge(Input::all(), array('id' => $id));
        try {
            
            $this->listForm->update($input);
            
        } catch (ValidationException $ex) {
            
            return Redirect::back()->withInput()->withErrors($ex->getErrors());

        }
        return Redirect::route('shipslists.index');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /shipslists/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        
        $list = $this->shipsList->byId($id);
        $customer = Customer::find($list->customer_id);
        $customer->status = 'new';
        $customer->save();
        
        $list->delete();
        
        return Redirect::back();
    }

}
