<?php

namespace Impl\Repo\ShipsNew;

use Impl\Repo\RepoAbstract;
use Illuminate\Database\Eloquent\Model;

class EloquentShipsNew extends RepoAbstract implements ShipsNewInterface {

    protected $shipsNew;

    // Class expects an Eloquent model
    public function __construct(Model $shipsNew) {
        
        $this->shipsNew = $shipsNew;
    }

    /**
     * Retrieve article by id
     * regardless of status
     *
     * @param  int $id Article ID
     * @return stdObject object of article information
     */
    public function byId($id) {
        
        return $this->shipsNew->find($id);
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
        $query = $this->shipsNew->with('customer.order','user')
                    ->orderBy('created_at', 'desc');
        if (!$all) {
            $query->where('status_id', 1);
        }

        $news = $query->skip($limit * ($page - 1))
                ->take($limit)
                ->get();

        $result->totalItems = $this->totalOrders($all);
        $result->items = $news->all();

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
        $query = $this->shipsNew->orderBy('created_at', 'desc');
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
        $this->shipsNew->user_id = $data['user_id'];
        $this->shipsNew->customer_id = $data['customer_id'];
        $this->shipsNew->receive_name = $data['receive_name'];
        $this->shipsNew->number_cv_pa71 = $data['number_cv_pa71'];
        $this->shipsNew->news_number = $data['news_number'];
        $this->shipsNew->page_number = $data['page_number'];
        $this->shipsNew->date_submit = $this->formatDateTimes($data['date_submit']);

        if (!$this->shipsNew->save()) {
            return false;
        }
        // update status colunm on Customer table
        $customer = \Customer::find($data['customer_id']);
        $customer->status = 'ok';
        $customer->save();
        return true;
    }

    /**
     * Update an existing Ship
     *
     * @param array  Data to update an Article
     * @return boolean
     */
    public function update(array $data) {
        
        $shipsNew = $this->byId($data['id']); 
        $shipsNew->user_id = $data['user_id'];
        $shipsNew->date_submit = $this->formatDateTimes($data['date_submit']);
        $shipsNew->number_cv_pa71 = $data['number_cv_pa71'];
        $shipsNew->customer_id = $data['customer_id'];
        $shipsNew->receive_name = $data['receive_name'];
        $shipsNew->news_number = $data['news_number'];
        $shipsNew->page_number = $data['page_number'];
        $shipsNew->save();

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
            return $this->shipsNew->where('status_id', 1)->count();
        }

        return $this->shipsNew->count();
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

}
