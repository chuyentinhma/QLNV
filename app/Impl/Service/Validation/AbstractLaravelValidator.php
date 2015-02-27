<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Impl\Service\Validation;

use Illuminate\Validation\Factory as Validator;


abstract class AbstractLaravelValidator implements ValidableInterface {
    
    /**
     * Validator
     * 
     * @var \Illuminate\Validation\Factory
     */
    
    protected $validator;
    /**
     * Validation data key=> value array
     * 
     * @var array
     */
    protected $data = [];
    
    /**
     * Validation Error
     * 
     * @var array
     */
    protected $errors = [];
    
    /**
     * Custom validation message
     * 
     * @var Array
     */
    protected $messages = [];
    
    /**
     * Validaton rules
     * 
     * @var Array
     */
    protected $rules = [];
    
    public function __construct(Validator $validator) {
        
        $this->validator = $validator;
        
    }

    /**
     * input data
     * 
     * @param Array $input Input request
     * @return Impl\Service\Validation\ValidableInterface
     */
    public function with(array $input) {
        
        $this->data = $input;
        
        return $this;
    }
    
    /**
     * Test if validation pass
     * 
     * @return boolean
     */
    public function passes() {
        
        $validator = $this->validator->make($this->data, $this->rules);
        
        if($validator->fails()) {
            
            return false;
            
        }
        
        return true;
    }
    
    /**
     * Retrieve validation errors
     * 
     * @return array
     */
    public function errors() {
        
        return $this->messages;
    }
    
    
    
}