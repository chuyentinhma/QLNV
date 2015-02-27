<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Impl\Service\Form\Category;

use \Impl\Service\Validation\AbstractLaravelValidator;

class CategoryFormValidator extends AbstractLaravelValidator {
    
    /**
     * Validaton rules
     * 
     * @var Array
     */
    protected $rules = [
        'symbol' => 'required',
        'description' => 'required'
  
    ];
    
    /**
     * Custom validation message
     * 
     * @var Array
     */
    protected $messages = [
        'symbol' => 'Phải nhập bí danh, và nó phải duy nhất',
        'description' => 'Phải nhập mô tả'

    ];
    
    
}
