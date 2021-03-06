<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Impl\Service\Form\Kind;

use Impl\Service\Validation\ValidableInterface;
use Impl\Service\Validation\AbstractLaravelValidator;
use Impl\Repo\Kind\KindInterface;
use Impl\Service\Validation\ValidationException;

class KindForm extends AbstractLaravelValidator{

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
    public $kind;
    
    /**
     * 
     * @param ValidableInterface $validator
     * @param OrderInterface $kind
     */
    public function __construct(ValidableInterface $validator, KindInterface $kind) {

        $this->validator = $validator;
        $this->kind = $kind;
    }

    /**
     * validate an create an new order
     * 
     * @param Array $input Input request
     * @return boolean true if save success
     */
    public function create(array $input) {

        if ($this->validate($input)) {

            return $this->kind->create($input);
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
            
            return $this->kind->update($input);
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
