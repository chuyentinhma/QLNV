<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Impl\Service\Form\Order;

use \Impl\Service\Validation\AbstractLaravelValidator;

class OrderFormValidator extends AbstractLaravelValidator {
    
    /**
     * Validaton rules
     * 
     * @var Array
     */
    protected $rules = [
        'created_at' => 'required',
        'customer_name' => 'required',
    ];
    
    /**
     * Custom validation message
     * 
     * @var Array
     */
    protected $messages = [
        'customer_name' => 'Phải nhập tên đối tượng',
        'created_at' => 'Chọn ngày yêu cầu'
    ];
    
    
}
