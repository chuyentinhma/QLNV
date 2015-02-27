<?php

use Impl\Service\Validation\ValidationException;
use Impl\Repo\Ship\ShipInterface;
use Impl\Service\Form\Ship\ShipForm;
use Impl\Repo\Purpose\PurposeInterface;
use Impl\Repo\User\UserInterface;

class ShipsController extends \BaseController {

    protected $purpose;
    protected $user;
    protected $shipForm;
    protected $ship;

    public function __construct(PurposeInterface $purpose, UserInterface $user, ShipInterface $ship, ShipForm $shipForm) {

        $this->purpose = $purpose;
        $this->user = $user;

        $this->ship = $ship;
        $this->shipForm = $shipForm;

        View::composer(['ships.create', 'ships.edit'], function ($view) {

            $purposes = $this->purpose->formatData($this->purpose->all());
            $users = $this->user->formatData($this->user->all());

            $view->with(array(
                'purposes' => $purposes,
                'users' => $users
            ));
        });
    }

    /**
     * Display a listing of ships
     *
     * @return Response
     */
    public function index() {
        
        $page = Input::get('page', 1);
        // Candidate for config item
        $perPage = 3;

        $pagiData = $this->ship->byPage($page, $perPage, true);

        $ships = Paginator::make($pagiData->items, $pagiData->totalItems, $perPage);
        
        return View::make('ships.index')->with('ships', $ships);
    }

    /**
     * Show the form for creating a new ship
     *
     * @return Response
     */
    public function create() {

        return View::make('ships.create');
    }

    /**
     * Store a newly created ship in storage.
     *
     * @return Response
     */
    public function store() {
        // Form processing
        try {

            $this->shipForm->create(Input::all());
            if (Input::get('redirect') == '1') {
//                // coutinue
                return Redirect::route('ships.create')->with('status', 'success');
            }
            return Redirect::route('ships.index')->with('status', 'success');
        } catch (ValidationException $ex) {
            if(is_array($ex->getErrors())) {
                return Redirect::back()->withInput()->withErrors($ex->getErrors());
            }
            return Redirect::back()->withInput()->with('error', $ex->getErrors());
        }
    }

    /**
     * Display the specified ship.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $ship = Ship::findOrFail($id);

        return View::make('ships.show', compact('ship'));
    }

    /**
     * Show the form for editing the specified ship.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $ship = Ship::find($id);

        return View::make('ships.edit', compact('ship'));
    }

    /**
     * Update the specified ship in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $ship = Ship::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Ship::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $ship->update($data);

        return Redirect::route('ships.index');
    }

    /**
     * Remove the specified ship from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        
        Ship::destroy($id);
        
        return Redirect::back();
    }

}
