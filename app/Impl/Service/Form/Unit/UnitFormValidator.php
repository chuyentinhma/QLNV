<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Impl\Service\Form\Unit;

use \Impl\Service\Validation\AbstractLaravelValidator;

class UnitFormValidator extends AbstractLaravelValidator {
    
    /**
     * Validaton rules
     * 
     * @var Array
     */
    protected $rules = [
        'name' => 'required',
        'symbol' => 'required',
  
    ];
    
    /**
     * Custom validation message
     * 
     * @var Array
     */
    protected $messages = [
        'name' => 'Phải nhập tên đơn vị',
        'symbol' => 'Phải nhập bí danh, và nó phải duy nhất',

    ];
    
    
}
