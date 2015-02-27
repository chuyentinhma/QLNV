<?php

namespace Impl\Repo\Ship;

use Impl\Repo\RepoAbstract;
use Illuminate\Database\Eloquent\Model;

class EloquentShip extends RepoAbstract implements ShipInterface {

    protected $ship;

    // Class expects an Eloquent model
    public function __construct(Model $ship) {
        $this->ship = $ship;
    }

    /**
     * Retrieve article by id
     * regardless of status
     *
     * @param  int $id Article ID
     * @return stdObject object of article information
     */
    public function byId($id) {
        return $this->ship->find($id);
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
        $query = $this->ship->with('customer.order','user')
                    ->orderBy('created_at', 'desc');
        if (!$all) {
            $query->where('status_id', 1);
        }

        $ships = $query->skip($limit * ($page - 1))
                ->take($limit)
                ->get();

        $result->totalItems = $this->totalOrders($all);
        $result->items = $ships->all();

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
        $query = $this->ship->orderBy('created_at', 'desc');
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
        $this->ship->date_submit = $this->formatDateTimes($data['date_submit']);
        $this->ship->number_cv_pa71 = $data['number_cv_pa71'];
        $this->ship->customer_id = $data['customer_id'];
        $this->ship->user_id = $data['user_id'];
        $this->ship->receive_name = $data['receive_name'];
        $this->ship->news_number = $data['news_number'];
        $this->ship->page_number = $data['page_number'];

        if (!$this->ship->save()) {
            return false;
        }

        return true;
    }

    /**
     * Update an existing Article
     *
     * @param array  Data to update an Article
     * @return boolean
     */
    public function update(array $data) {

        $ship = $this->ship->find($data['id']);

        $ship->number_cv = $data['number_cv'];
        $ship->unit_id = $data['unit'];

        $ship->number_cv_pa71 = $data['number_cv_pa71'];
        $ship->customer_name = $data['customer_name'];

        $ship->ship_name = $data['ship_name'];
        $ship->ship_phone = $data['ship_phone_number'];

        $ship->category_id = $data['category'];
        $ship->kind_id = $data['kind'];
        $ship->user_id = $data['user_get'];
        $ship->date_submit = $this->formatDateTimes($data['created_at']);
        $ship->date_begin = $this->formatDateTimes($data['date_begin']);
        $ship->date_end = $this->formatDateTimes($data['date_end']);
        $ship->comment = $data['comment'];
        $ship->save();

        $this->syncDataRelation($ship, $data);

        return true;
    }

    /**
     * Sync data for customers an ships_purposes
     *
     * @param \Illuminate\Database\Eloquent\Model  $ship
     * @param array  $data from input request
     * @return void
     */
    protected function syncDataRelation(Model $ship, array $data) {

        $phoneNumber = explode(',', $data['customer_phone_number']);
        foreach ($phoneNumber as $phone) {
            $customer = new \Customer(array('phone_number' => $phone));
            $ship->customers()->save($customer);
        }

        $ship->purposes()->sync($data['purpose']);
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
            return $this->ship->where('status_id', 1)->count();
        }

        return $this->ship->count();
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
