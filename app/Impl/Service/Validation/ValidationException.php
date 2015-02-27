<?php
namespace Impl\Service\Validation;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ValidationException extends \Exception {
    
    protected $messages;

    public function __construct($typeErros, $message = '') 
    {
        $this->messages = $message;

        parent::__construct($typeErros);
    }

    public function getErrors()
    {
        return $this->messages;
    }
}