<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Impl\Service\Form\Category;

use Impl\Service\Validation\ValidableInterface;
use Impl\Service\Validation\AbstractLaravelValidator;
use Impl\Repo\Category\CategoryInterface;
use Impl\Service\Validation\ValidationException;

class CategoryForm extends AbstractLaravelValidator{

    /**
     * Form data
     * 
     * @var Array
     */
    public $data = [];

    /**
     * Validator
     * 
     * @var Object \Impl\Service\Validation\ValidableInterface;
     */
    public $validator;

    /**
     * Order
     * 
     * @var Object \Impl\Repo\Order\OrderInterface;
     */
    public $category;
    
    /**
     * 
     * @param ValidableInterface $validator
     * @param OrderInterface $category
     */
    public function __construct(ValidableInterface $validator, CategoryInterface $category) {

        $this->validator = $validator;
        $this->category = $category;
    }

    /**
     * validate an create an new order
     * 
     * @param Array $input Input request
     * @return boolean true if save success
     */
    public function create(array $input) {

        if ($this->validate($input)) {

            return $this->category->create($input);
        }

        return false;
    }
    
    /**
     * validate an update an new order
     * 
     * @param Array $input Input request
     * @return boolean true if save success
     */
    public function update(array $input) {
        
        if( $this->validate($input) ) {
            
            return $this->category->update($input);
        }
        
        return false;
        
    }

        /**
     * Test if form validator passes
     * 
     * @param array $input Input reques
     * @return boolean true if passes
     */
    public function validate(array $input) {

        if (!$this->validator->with($input)->passes()) {

            throw new ValidationException('Validation Failed', $this->validator->errors());
        }
        return true;
    }

}
