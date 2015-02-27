<?php
namespace Impl\Repo\Kind;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Impl\Repo\RepoAbstract;
use Illuminate\Database\Eloquent\Model;

class EloquentKind extends RepoAbstract implements KindInterface {
    
    protected $kind;
    
    public function __construct(Model $kind) {
        
        $this->kind = $kind;
    }

    /**
     * Get all Users
     * @return Array Arrayable collection
     */
    public function all() {
        
        return $this->kind->all();
    }
    
    public function byPage($page = 1, $limit = 10) {

        $result = new \StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $units = $this->kind->orderBy('created_at', 'desc')
                ->skip($limit * ($page - 1))
                ->take($limit)
                ->get();

        $result->totalItems = $this->kind->count();
        $result->items = $units->all();

        return $result;
    }

    public function create(array $data) {
        
        $this->kind->symbol = $data['symbol'];
        $this->kind->description = $data['description'];
        if (!$this->kind->save()) {
            return false;
        }
        
        return true;
        
    }

    public function update(array $data) {
        
        $category = $this->kind->find($data['id']);
        
        $category->symbol = $data['symbol'];
        $category->description = $data['description'];
        $category->save();
        
        return true;
        
    }
    
    
}
