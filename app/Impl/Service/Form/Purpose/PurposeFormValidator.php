<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Impl\Service\Form\Purpose;

use \Impl\Service\Validation\AbstractLaravelValidator;

class PurposeFormValidator extends AbstractLaravelValidator {
    
    /**
     * Validaton rules
     * 
     * @var Array
     */
    protected $rules = [
        'content_purpose' => 'required',
  
    ];
    
    /**
     * Custom validation message
     * 
     * @var Array
     */
    protected $messages = [
        'content_purpose' => 'Phải nhập bí danh, và nó phải duy nhất',

    ];
    
    
}
