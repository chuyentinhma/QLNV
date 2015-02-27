<?php

namespace Impl\Repo\Unit;

use Impl\Repo\RepoAbstract;
use Illuminate\Database\Eloquent\Model;

class EloquentUnit extends RepoAbstract implements UnitInterface {

    protected $unit;

    public function __construct(Model $unit) {
        $this->unit = $unit;
    }

    /**
     * Get all Statuses
     * @return Array Arrayable collection
     */
    public function all() {

        return $this->unit->all();
    }

    /**
     * Get specific status
     * @param  int $id Status ID
     * @return object  Status object
     */
    public function byId($id) {
        
        return $this->unit->find($id);
    }

    /**
     * Get specific status
     * @param  string $slug Status slug
     * @return object  Status object
     */
    public function byStatus($slug) {
        return $this->unit->where('slug', $slug);
    }

    public function byPage($page = 1, $limit = 10) {

        $result = new \StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $units = $this->unit->orderBy('created_at', 'desc')
                    ->skip($limit * ($page - 1))
                    ->take($limit)
                    ->get();

        $result->totalItems = $this->unit->count();
        $result->items = $units->all();

        return $result;
    }
    /**
     * Create a new Unit
     *
     * @param array  Data to create a new object
     * @return boolean
     */
    public function create(array $data) {

        $this->unit->symbol = $data['symbol'];
        $this->unit->name = $data['name'];
        $this->unit->block = $data['block'];
        if (!$this->unit->save()) {
            return false;
        }
        
        return true;
    }

    /**
     * Update an existing Unit
     *
     * @param array  Data to update an Article
     * @return boolean
     */
    public function update(array $data){
        
        $unit = $this->unit->find($data['id']);
        
        $unit->name = $data['name'];
        $unit->symbol = $data['symbol'];
        $unit->block = $data['block'];
        $unit->save();
        
        return true;
    }

}
