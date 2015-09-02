<?php

use Impl\Repo\Unit\UnitInterface;
use Impl\Service\Form\Unit\UnitForm;
use Impl\Service\Validation\ValidationException;

class UnitsController extends \BaseController {

    protected $unit;
    protected $unitForm;

    public function __construct(UnitInterface $unit, UnitForm $unitForm) {

        $this->unit = $unit;
        $this->unitForm = $unitForm;
    }

    /**
     * Display a listing of units
     *
     * @return Response
     */
    public function index() {
        $page = Input::get('page', 1);
        // Candidate for config item
        $perPage = 10;

        $pagiData = $this->unit->byPage($page, $perPage);
        $units = Paginator::make($pagiData->items, $pagiData->totalItems, $perPage);

        return View::make('units.index', compact('units'));
    }

    /**
     * Show the form for creating a new unit
     *
     * @return Response
     */
    public function create() {
        return View::make('units.create');
    }

    /**
     * Store a newly created unit in storage.
     *
     * @return Response
     */
    public function store() {

        // Form processing
        try {

            $this->unitForm->create(Input::all());
            if (Input::get('redirect') == '1') {
//                // coutinue
                return Redirect::route('units.create')->with('success', 'Tạo mới thành công');
            }
            return Redirect::route('units.index')->with('success', 'Tạo mới thành công');
        } catch (ValidationException $ex) {

            return Redirect::back()->withInput()->withErrors($ex->getErrors())->with('error', 'Đã xảy ra lỗi');
        }
    }

    /**
     * Display the specified unit.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        
        $unit = Unit::findOrFail($id);

        return View::make('units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified unit.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {

        $unit = Unit::find($id);

        return View::make('units.edit', compact('unit'));
    }

    /**
     * Update the specified unit in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

        $input = array_merge(Input::all(), array('id' => $id));
        
        try {
            
            $this->unitForm->update($input);
            
        } catch (ValidationException $ex) {

            return Redirect::back()->withInput()->withErrors($ex->getErrors())->with('error','Đã xảy ra lỗi');
        }

        return Redirect::route('units.index');
    }

    /**
     * Remove the specified unit from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        
        Unit::destroy($id);

        return Redirect::back();
    }

}
