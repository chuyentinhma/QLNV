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
        'number_cv' => 'required',
        'number_cv_pa71' => 'rquired',
        'purpose' => 'required',
        'customer_name' => 'required',
        'date_begin' => 'required',
        'date_end' => 'required',
        'file' => 'max:5400'
    ];
    
    /**
     * Custom validation message
     * 
     * @var Array
     */
    protected $messages = [
        'customer_name' => 'Phải nhập tên đối tượng',
        'created_at' => 'Chọn ngày yêu cầu',
        'number_cv' => 'Nhập số công văn đơn vị yêu cầu',
        'number_cv_pa71' => 'Nhập số công văn PA 71',
        'purpose' => 'Chọn mục đích yêu cầu',
        'date_begin' => 'Nhập ngày bắt đầu',
        'date_end' => 'Nhập ngày kết thúc',
        'file' => 'dung luong file tối đa 5MB'
    ];
    
    
}
