<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Impl\Service\Form\ShipsList;

use \Impl\Service\Validation\AbstractLaravelValidator;

class ShipsListFormValidator extends AbstractLaravelValidator {
    
    /**
     * Validaton rules
     * 
     * @var Array
     */
    protected $rules = [
        'customer_id' => 'required',
        'date_submit' => 'required',
        'page_number' => 'required'
    ];
    
    /**
     * Custom validation message
     * 
     * @var Array
     */
    protected $messages = [
        'customer_id' => 'Phải chọn thuê bao đã đăng ký',
        'date_submit' => 'Phải nhập ngày giao',
        'page_number' => 'Phải nhập số trang'
    ];
    
    
}
