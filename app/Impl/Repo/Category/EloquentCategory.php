<?php

namespace Impl\Repo\Category;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Impl\Repo\RepoAbstract;
use Illuminate\Database\Eloquent\Model;

class EloquentCategory extends RepoAbstract implements CategoryInterface {

    protected $category;

    public function __construct(Model $category) {

        $this->category = $category;
    }

    /**
     * Get all Categorys
     * @return Array Arrayable collection
     */
    public function all() {

        return $this->category->all();
    }

    public function byPage($page = 1, $limit = 10) {

        $result = new \StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $units = $this->category->orderBy('created_at', 'desc')
                ->skip($limit * ($page - 1))
                ->take($limit)
                ->get();

        $result->totalItems = $this->category->count();
        $result->items = $units->all();

        return $result;
    }

    public function create(array $data) {
        
        $this->category->symbol = $data['symbol'];
        $this->category->description = $data['description'];
        if (!$this->category->save()) {
            return false;
        }
        
        return true;
        
    }

    public function update(array $data) {
        
        $category = $this->category->find($data['id']);
        
        $category->symbol = $data['symbol'];
        $category->description = $data['description'];
        $category->save();
        
        return true;
        
    }

}
