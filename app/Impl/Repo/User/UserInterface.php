<?php
namespace Impl\Repo\User;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
interface UserInterface {
    
    /**
     * Get all Users
     * @return Array Arrayable collection
     */
    public function all();
}
