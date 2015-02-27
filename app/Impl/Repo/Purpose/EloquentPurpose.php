<?php
namespace Impl\Repo\Purpose;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Impl\Repo\RepoAbstract;
use Illuminate\Database\Eloquent\Model;

class EloquentPurpose extends RepoAbstract implements PurposeInterface {
    
    protected $purpose;
    
    public function __construct(Model $purpose) {
        
        $this->purpose = $purpose;
    }

    /**
     * Get all Purposes
     * @return Array Arrayable collection
     */
    public function all() {
        
        return $this->purpose->all(array('id','content as symbol'));
    }
    public function byPage($page = 1, $limit = 10) {

        $result = new \StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $purposes = $this->purpose->orderBy('created_at', 'desc')
                ->skip($limit * ($page - 1))
                ->take($limit)
                ->get();

        $result->totalItems = $this->purpose->count();
        $result->items = $purposes->all();

        return $result;
    }

    public function create(array $data) {
        
        $this->purpose->content = $data['content_purpose'];
        $this->purpose->comment = $data['comment'];
        if (!$this->purpose->save()) {
            return false;
        }
        
        return true;
        
    }

    public function update(array $data) {
        
        $purpose = $this->purpose->find($data['id']);
        
        $purpose->content = $data['content_purpose'];
        $purpose->comment = $data['comment'];
        $purpose->save();
        
        return true;
        
    }
}
