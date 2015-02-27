<?php

use Impl\Service\Form\Category\CategoryForm;
use Impl\Repo\Category\CategoryInterface;

class CategoriesController extends \BaseController {
    
    protected $category;
    protected $categoryForm;
    
    public function __construct(CategoryInterface $category, CategoryForm $categoryForm) {
        
        $this->category = $category;
        $this->categoryForm = $categoryForm;
    }

    /**
     * Display a listing of categories
     *
     * @return Response
     */
    public function index() {
        
        $page = Input::get('page', 1);
        // Candidate for config item
        $perPage = 3;

        $pagiData = $this->category->byPage($page, $perPage);
        $categories = Paginator::make($pagiData->items, $pagiData->totalItems, $perPage);

        return View::make('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     *
     * @return Response
     */
    public function create() {
        return View::make('categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @return Response
     */
    public function store() {
        
                // Form processing
        try {

            $this->categoryForm->create(Input::all());
            if (Input::get('redirect') == '1') {
//                // coutinue
                return Redirect::route('categories.create')->with('success', 'Tạo mới thành công');
            }
            return Redirect::route('categories.index')->with('success', 'Tạo mới thành công');
        } catch (ValidationException $ex) {

            return Redirect::back()->withInput()->withErrors($ex->getErrors())->with('error', 'Đã xảy ra lỗi');
        }
        
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $category = Category::findOrFail($id);

        return View::make('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $category = Category::find($id);

        return View::make('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        
        $input = array_merge(Input::all(), array('id' => $id));
        
        try {
            
            $this->categoryForm->update($input);
            
        } catch (ValidationException $ex) {

            return Redirect::back()->withInput()->withErrors($ex->getErrors())->with('error','Đã xảy ra lỗi');
        }

        return Redirect::route('categories.index');
        
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        Category::destroy($id);
        
        return Redirect::back();
    }

}
