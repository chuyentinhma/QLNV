<?php

namespace Impl\Repo\ShipsList;

use Impl\Repo\RepoAbstract;
use Illuminate\Database\Eloquent\Model;

class EloquentShipsList extends RepoAbstract implements ShipsListInterface {

    protected $shipsList;

    // Class expects an Eloquent model
    public function __construct(Model $shipsList) {
        
        $this->shipsList = $shipsList;
    }

    /**
     * Retrieve article by id
     * regardless of status
     *
     * @param  int $id Article ID
     * @return stdObject object of article information
     */
    public function byId($id) {
        return $this->shipsList->find($id);
    }

    /**
     * Get paginated ships
     *
     * @param int $page Number of ships per page
     * @param int $limit Results per page
     * @param boolean $all Show published or all
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function byPage($page = 1, $limit = 10, $all = false) {
        $result = new \StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();
        $query = $this->shipsList->with('customer.order.purposes','user')
                    ->with('customer.order.unit')
                    ->with('customer.order.kind')
                    ->with('customer.order.category')
                    ->orderBy('created_at', 'desc');
        if (!$all) {
            $query->where('status_id', 1);
        }

        $lists = $query->skip($limit * ($page - 1))
                ->take($limit)
                ->get();
        $result->totalItems = $this->totalOrders($all);
        $result->items = $lists->all();

        return $result;
    }

    /**
     * Get all ship by Status
     *
     * @param string  URL slug of article
     * @return object object of article information
     */
    public function byStatus($status = false) {
        $result = new \StdClass;
        $result->items = array();
        $query = $this->shipsList->orderBy('created_at', 'desc');
        if (!$status) {
            $query->where('status', 1);
        }
        $ship = $query->with();
        $result->items = $ships->all();

        return $result;
    }

    /**
     * Get articles by their tag
     *
     * @param string  URL slug of tag
     * @param int Number of articles per page
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function byTag($tag, $page = 1, $limit = 10) {
        $foundTag = $this->tag->where('slug', $tag)->first();

        $result = new \StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        if (!$foundTag) {
            return $result;
        }

        $articles = $this->tag->articles()
                ->where('articles.status_id', 1)
                ->orderBy('articles.created_at', 'desc')
                ->skip($limit * ($page - 1))
                ->take($limit)
                ->get();

        $result->totalItems = $this->totalByTag();
        $result->items = $articles->all();

        return $result;
    }

    /**
     * Create a new Order
     *
     * @param array  Data to create a new object
     * @return boolean
     */
    public function create(array $data) {
        // Create new the object ship
        $this->shipsList->date_submit = $this->formatDateTimes($data['date_submit']);
        $this->shipsList->customer_id = $data['customer_id'];
        $this->shipsList->user_id = $data['user_id'];
        $this->shipsList->receive_name = $data['receive_name'];
        $this->shipsList->page_number = $data['page_number'];

        if (!$this->shipsList->save()) {
            return false;
        }
        // update status colunm on Customer table
        $this->updateStatusPhone($data['customer_id'], 'ok');
        
        return true;
    }

    /**
     * Update an existing Ship
     *
     * @param array  Data to update an Article
     * @return boolean
     */
    public function update(array $data) {

        $shipsList = $this->byId($data['id']);
        // check customer_id and update status phone_number
        if($data['customer_id'] != $shipsList->customer_id) {
            $this->updateStatusPhone($shipsList->customer_id, 'new');
            $this->updateStatusPhone($data['customer_id'], 'ok');
        }
        $shipsList->user_id = $data['user_id'];
        $shipsList->date_submit = $this->formatDateTimes($data['date_submit']);
        $shipsList->customer_id = $data['customer_id'];
        $shipsList->receive_name = $data['receive_name'];
        $shipsList->page_number = $data['page_number'];
        $shipsList->save();
        
        return true;
    }
    
    /**
     * Get total ships count
     *
     * @todo I hate that this is public for the decorators.
     *       Perhaps interface it?
     * @return int  Total articles
     */
    protected function totalOrders($all = false) {
        if (!$all) {
            return $this->shipsList->where('status_id', 1)->count();
        }

        return $this->shipsList->count();
    }

    /**
     * Get total article count per tag
     *
     * @todo I hate that this is public for the decorators
     *       Perhaps interface it?
     * @param  string  $tag  Tag slug
     * @return int     Total articles per tag
     */
    protected function totalByTag($tag) {
        return $this->tag->bySlug($tag)
                        ->articles()
                        ->where('status_id', 1)
                        ->count();
    }
    /**
     * 
     * @param int $id
     * @param string $status
     */
    protected function updateStatusPhone($id, $status) {
        
        $customer = \Customer::find($id);
        $customer->status = $status;
        $customer->save();
    }

}
