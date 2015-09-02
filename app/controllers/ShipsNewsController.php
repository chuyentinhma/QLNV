<?php

use Impl\Service\Validation\ValidationException;
use Impl\Repo\ShipsNew\ShipsNewInterface;
use Impl\Service\Form\ShipsNew\ShipsNewForm;
use Impl\Repo\Order\OrderInterface;
use Impl\Repo\User\UserInterface;

class ShipsNewsController extends \BaseController {

    protected $order;
    protected $user;
    protected $newForm;
    protected $shipsNew;

    public function __construct(OrderInterface $order, UserInterface $user, ShipsNewInterface $shipsNew, ShipsNewForm $newForm) {
        
        $this->order = $order;
        $this->user = $user;

        $this->shipsNew = $shipsNew;
        $this->newForm = $newForm;

        View::composer(['shipsnews.create', 'shipsnews.edit'], function ($view) {

            $orders = $this->order->all('giam_sat');
            $users = $this->user->formatData($this->user->all());
            
            $view->with(array(
                'orders' => $orders,
                'users' => $users
            ));
        });
    }

    /**
     * Display a listing of the resource.
     * GET /shipsnews
     *
     * @return Response
     */
    public function index() {
        
        $page = Input::get('page', 1);
        // Candidate for config item
        $perPage = 10;

        $pagiData = $this->shipsNew->byPage($page, $perPage, true);

        $news = Paginator::make($pagiData->items, $pagiData->totalItems, $perPage);

        return View::make('shipsnews.index')->with('news', $news);
        
    }

    /**
     * Show the form for creating a new resource.
     * GET /shipsnews/create
     *
     * @return Response
     */
    public function create() {
        return View::make('shipsnews.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /shipsnews
     *
     * @return Response
     */
    public function store() {
        
        // Form processing
        try {
            $this->newForm->create(Input::all());
            if (Input::get('redirect') == '1') {
                // coutinue
                return Redirect::route('shipsnews.create')->with('status', 'success');
            }
            return Redirect::route('shipsnews.index')->with('status', 'success');
            
        } catch (ValidationException $ex) {
            if(is_array($ex->getErrors())) {
                return Redirect::back()->withInput()->withErrors($ex->getErrors());
            }
            return Redirect::back()->withInput()->with('error', $ex->getErrors());
        }
    }

    /**
     * Display the specified resource.
     * GET /shipsnews/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     * GET /shipsnews/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        
        $new = $this->shipsNew->byId($id);

        return View::make('shipsnews.edit', compact('new'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /shipsnews/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        
        $input = array_merge(Input::all(), array('id' => $id));
        try {
            
            $this->newForm->update($input);
            
        } catch (ValidationException $ex) {
            
            return Redirect::back()->withInput()->withErrors($ex->getErrors());

        }
        return Redirect::route('shipsnews.index');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /shipsnews/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        
        $new = $this->shipsNew->byId($id);
        $new->delete();
        return Redirect::back();
    }

}
