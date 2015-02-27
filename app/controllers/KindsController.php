<?php

use Impl\Repo\Kind\KindInterface;
use Impl\Service\Form\Kind\KindForm;


class KindsController extends \BaseController {
    
    protected $kind;
    protected $kindForm;
    
    public function __construct(KindInterface $kind, KindForm $kindForm) {
        
        $this->kind = $kind;
        $this->kindForm = $kindForm;
    }

    /**
     * Display a listing of kinds
     *
     * @return Response
     */
    public function index() {
        
        $page = Input::get('page', 1);
        // Candidate for config item
        $perPage = 3;

        $pagiData = $this->kind->byPage($page, $perPage);
        $kinds = Paginator::make($pagiData->items, $pagiData->totalItems, $perPage);

        return View::make('kinds.index', compact('kinds'));
    }

    /**
     * Show the form for creating a new kind
     *
     * @return Response
     */
    public function create() {
        return View::make('kinds.create');
    }

    /**
     * Store a newly created kind in storage.
     *
     * @return Response
     */
    public function store() {
      
        // Form processing
        try {

            $this->kindForm->create(Input::all());
            if (Input::get('redirect') == '1') {
//                // coutinue
                return Redirect::route('kinds.create')->with('success', 'Tạo mới thành công');
            }
            return Redirect::route('kinds.index')->with('success', 'Tạo mới thành công');
        } catch (ValidationException $ex) {

            return Redirect::back()->withInput()->withErrors($ex->getErrors())->with('error', 'Đã xảy ra lỗi');
        }
        
    }

    /**
     * Display the specified kind.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $kind = Kind::findOrFail($id);

        return View::make('kinds.show', compact('kind'));
    }

    /**
     * Show the form for editing the specified kind.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        
        $kind = Kind::find($id);

        return View::make('kinds.edit', compact('kind'));
    }

    /**
     * Update the specified kind in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        
        $input = array_merge(Input::all(), array('id' => $id));
        
        try {
            
            $this->kindForm->update($input);
            
        } catch (ValidationException $ex) {

            return Redirect::back()->withInput()->withErrors($ex->getErrors())->with('error','Đã xảy ra lỗi');
        }

        return Redirect::route('kinds.index');
    }

    /**
     * Remove the specified kind from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        
        Kind::destroy($id);

        return Redirect::back();
    }

}
