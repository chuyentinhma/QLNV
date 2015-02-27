<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Impl\Service\Form\Ship;

use \Impl\Service\Validation\AbstractLaravelValidator;

class ShipFormValidator extends AbstractLaravelValidator {
    
    /**
     * Validaton rules
     * 
     * @var Array
     */
    protected $rules = [
        'date_submit' => 'required',
        'number_cv_pa71' => 'required',
    ];
    
    /**
     * Custom validation message
     * 
     * @var Array
     */
    protected $messages = [
        'date_submit' => 'Phải nhập ngày giao',
        'number_cv_pa71' => 'Phải nhập số công văn'
    ];
    
    
}
