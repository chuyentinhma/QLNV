<?php


use Impl\Repo\Purpose\PurposeInterface;
use Impl\Service\Form\Purpose\PurposeForm;

class PurposesController extends \BaseController {
    
    protected $purpose;
    protected $purposeForm;
    
    public function __construct(PurposeInterface $purpose, PurposeForm $purposeForm) {
        
        $this->purpose = $purpose;
        $this->purposeForm = $purposeForm;
    }

    /**
     * Display a listing of the resource.
     * GET /purposes
     *
     * @return Response
     */
    public function index() {
        
        $page = Input::get('page', 1);
        // Candidate for config item
        $perPage = 10;

        $pagiData = $this->purpose->byPage($page, $perPage);
        $purposes = Paginator::make($pagiData->items, $pagiData->totalItems, $perPage);

        return View::make('purposes.index', compact('purposes'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /purposes/create
     *
     * @return Response
     */
    public function create() {
        //
        return View::make('purposes.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /purposes
     *
     * @return Response
     */
    public function store() {
        
        // Form processing
        try {

            $this->purposeForm->create(Input::all());
            if (Input::get('redirect') == '1') {
//                // coutinue
                return Redirect::route('purposes.create')->with('success', 'Tạo mới thành công');
            }
            return Redirect::route('purposes.index')->with('success', 'Tạo mới thành công');
        } catch (ValidationException $ex) {

            return Redirect::back()->withInput()->withErrors($ex->getErrors())->with('error', 'Đã xảy ra lỗi');
        }
        
    }

    /**
     * Display the specified resource.
     * GET /purposes/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /purposes/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        
         $purpose = Purpose::find($id);

        return View::make('purposes.edit', compact('purpose'));
        
    }

    /**
     * Update the specified resource in storage.
     * PUT /purposes/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        
        $input = array_merge(Input::all(), array('id' => $id));
        
        try {
            
            $this->purposeForm->update($input);
            
        } catch (ValidationException $ex) {

            return Redirect::back()->withInput()->withErrors($ex->getErrors())->with('error','Đã xảy ra lỗi');
        }

        return Redirect::route('purposes.index');
        
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /purposes/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        
        Purpose::destroy($id);
        
        return Redirect::back();
        
    }

}
