<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Impl\Service\Form\ShipsNew;

use \Impl\Service\Validation\AbstractLaravelValidator;

class ShipsNewFormValidator extends AbstractLaravelValidator {
    
    /**
     * Validaton rules
     * 
     * @var Array
     */
    protected $rules = [
        'customer_id' => 'required',
        'date_submit' => 'required',
        'number_cv_pa71' => 'required',
        'news_number' => 'required',
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
        'number_cv_pa71' => 'Phải nhập số công văn',
        'news_number' => 'Phải nhập số bản tin',
        'page_number' => 'Phải nhập số trang tin'
    ];
    
    
}
