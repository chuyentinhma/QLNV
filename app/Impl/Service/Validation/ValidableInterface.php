<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Impl\Service\Validation;

interface ValidableInterface {
    /**
     * input data
     * 
     * @param Array $input Input request
     * @return Impl\Service\Validation\ValidableInterface
     */
    public function with(array $input);
    
    /**
     * Test if validation pass
     * 
     * @return boolean
     */
    public function passes();
    
    /**
     * Retrieve validation errors
     * 
     * @return array
     */
    public function errors();
    
}
