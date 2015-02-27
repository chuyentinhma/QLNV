<?php
namespace Impl\Repo\User;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Impl\Repo\RepoAbstract;
use Illuminate\Database\Eloquent\Model;

class EloquentUser extends RepoAbstract implements UserInterface {
    
    protected $user;
    
    public function __construct(Model $user) {
        
        $this->user = $user;
    }

    /**
     * Get all Users
     * @return Array Arrayable collection
     */
    public function all() {
        
        return $this->user->all(array('id as id', 'username as symbol'));
    }
}
