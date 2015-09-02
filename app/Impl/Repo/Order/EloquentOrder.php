<?php

namespace Impl\Repo\Order;

use Impl\Repo\RepoAbstract;
use Illuminate\Database\Eloquent\Model;

class EloquentOrder extends RepoAbstract implements OrderInterface {

    protected $order;

//    protected $tag
    // Class expects an Eloquent model
    public function __construct(Model $order) {
        $this->order = $order;
    }
    
    /**
     * Get all Order
     * @return Array Arrayable collection
     */
    public function all($purpose = '') {

        $query = $this->order->orderBy('date_submit','desc');
        
        switch ($purpose) {
            case 'list':
                $query = $query->with(['unit', 'customers' => function($q) {
                    $q->where('status', '<>', 'ok');
                }])
                    ->whereHas('purposes', function ($p) {
                    $p->where('content', '<>', 'giám sát');
                });
                break;
            case 'giam_sat':
                $query = $query->with(['unit', 'customers' => function($q) {
                    $q->where('status', '=', 'ok');
                }])
                    ->whereHas('purposes', function ($q) {

                    $q->where('content', '=', 'giám sát');
                });
                break; 
        }
        $orders = $query->get();
        $result = $orders->all();

        return $result;
    }
    /**
     * Retrieve article by id
     * regardless of status
     *
     * @param  int $id Article ID
     * @return stdObject object of article information
     */
    public function byId($id) {
        return $this->order->find($id);
    }

    /**
     * Get paginated orders
     *
     * @param int $page Number of orders per page
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

        $query = $this->order->with(['unit', 'kind', 'user', 'category', 'customers', 'purposes'])
                    ->orderBy('date_submit', 'desc');
        if (!$all) {
            $query->where('status_id', 1);
        }

        $orders = $query->skip($limit * ($page - 1))
                ->take($limit)
                ->get();

        $result->totalItems = $this->totalOrders($all);
        $result->items = $orders->all();

        return $result;
    }

    /**
     * Get all order by Status
     *
     * @param string  URL slug of article
     * @return object object of article information
     */
    public function byPhone($phone) {
        $result = new \StdClass;
        $result->items = array();
        $query = $this->order->orderBy('created_at', 'desc');

        $order = $this->order->join('customers', 'customers.order_id', '=', 'orders.id')
                ->where('customers.phone_number', '=', $phone)
                ->get();
        $result->items = $order->all();

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

    public function searchName($keysearch, $purpose, $page = 1, $limit = 10) {
        $result = new \StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();
        $query = $this->order->orderBy('date_submit', 'desc');

        if ($keysearch != '') {
            $query = $query->where('customer_name', 'like', '%' . $keysearch . '%');
        }
        switch ($purpose) {
            // giám sát
            case 'DS Giám sát':
                $query = $query->whereHas('purposes', function ($q) {

                    $q->where('content', '=', 'giám sát');
                });
                break;
            // list
            case 'DS List':
                $query = $query->whereHas('purposes', function ($q) {
                    $q->where('content', '!=', 'giám sát');
                });
                break;
        }
        $result->totalItems = $query->count();
        $orders = $query->skip($limit * ($page - 1))
                ->take($limit)
                ->get();
        $result->items = $orders->all();
        return $result;
    }

    /**
     * Create a new Order
     *
     * @param array  Data to create a new object
     * @return boolean
     */
    public function create(array $data) {
        $fileName = '';
        $extention = '';
        if (\Input::hasFile('file')) {
            $alowedExtension = ['doc', 'docx', 'pdf', 'xls', 'xlsx'];
            $file = \Input::file('file');
            $destinationPath = public_path() . '\uploads\orders';
            $extention = $file->getClientOriginalExtension();
            $fileName = $this->slug($data['customer_name']) . '_' . \Carbon\Carbon::now()->timestamp . '.' . $extention;

            if (in_array($extention, $alowedExtension)) {
                $file->move($destinationPath, $fileName);
            }
        }
        // Create new the object order
        $this->order->number_cv = $data['number_cv'];
        $this->order->unit_id = $data['unit'];

        $this->order->number_cv_pa71 = $data['number_cv_pa71'];
        $this->order->customer_name = $data['customer_name'];

        $this->order->order_name = $data['order_name'];
        $this->order->order_phone = $data['order_phone_number'];

        $this->order->category_id = $data['category'];
        $this->order->kind_id = $data['kind'];
        $this->order->user_id = $data['user_get'];
        $this->order->date_submit = $this->formatDateTimes($data['created_at']);
        $this->order->date_begin = $this->formatDateTimes($data['date_begin']);
        $this->order->date_end = $this->formatDateTimes($data['date_end']);
        $this->order->comment = $data['comment'];
        $this->order->file_attach = $fileName;

        if (!$this->order->save()) {
            return false;
        }
        $phoneNumber = explode(',', $data['customer_phone_number']);
        foreach ($phoneNumber as $phone) {
            $customer = new \Customer(array('phone_number' => $phone, 'status' => 'new'));
            $this->order->customers()->save($customer);
        }
        $this->order->purposes()->sync($data['purpose']);

        return true;
    }

    /**
     * Update an existing Article
     *
     * @param array  Data to update an Article
     * @return boolean
     */
    public function update(array $data) {
//        var_dump($data);
//        die;
        $order = $this->order->find($data['id']);

        $order->number_cv = $data['number_cv'];
        $order->unit_id = $data['unit'];

        $order->number_cv_pa71 = $data['number_cv_pa71'];
        $order->customer_name = $data['customer_name'];

        $order->order_name = $data['order_name'];
        $order->order_phone = $data['order_phone_number'];

        $order->category_id = $data['category'];
        $order->kind_id = $data['kind'];
        $order->user_id = $data['user_get'];
        $order->date_submit = $this->formatDateTimes($data['created_at']);
        $order->date_begin = $this->formatDateTimes($data['date_begin']);
        $order->date_end = $this->formatDateTimes($data['date_end']);
        $order->comment = $data['comment'];
        $order->save();

        $order->purposes()->sync($data['purpose']);

        return true;
    }

    /**
     * Sync data for customers an orders_purposes
     *
     * @param \Illuminate\Database\Eloquent\Model  $order
     * @param array  $data from input request
     * @return void
     */
    protected function syncDataRelation(Model $order, array $data) {

        $phoneNumber = explode(',', $data['customer_phone_number']);
        $customers = \Customer::where('order_id', '=', $order->id)->get();
        $output = [];
        foreach ($customers as $customer) {

            $output[$customer->id] = $customer->phone_number;
        }

        if (count($phoneNumber) == count($output)) {
            // change
            if (array_diff($phoneNumber, $output)) {

                foreach ($customers as $index => $customer) {

                    $customer->phone_number = $phoneNumber[$index++];
                    $customer->order()->associate($order);
                    $customer->save();
                }
            }
        }
        // add
        elseif (count($phoneNumber) > count($output)) {

            var_dump('them');
        }
        // delete
        else {
            var_dump('xoa bot');
        }

        die;
        $order->purposes()->sync($data['purpose']);
    }

    public function countNewOrder($timeStart, $timeEnd) {

        return $this->order->whereTime($timeStart, $timeEnd)
                        ->count();
    }

    public function countPurposesOrder($timeStart, $timeEnd) {

        $a = $this->order->select(\DB::raw('count(purposes.content) as count_name,content'))
                ->join('orders_purposes', 'orders.id', '=', 'orders_purposes.order_id')
                ->join('purposes', 'orders_purposes.purpose_id', '=', 'purposes.id')
                ->whereTime($timeStart, $timeEnd)
                ->groupBy('purposes.content')
                ->get();
        return $a->all();
    }

    public function countUnitOrder($timeStart, $timeEnd) {

        $a = $this->order->select(\DB::raw('count(units.symbol) as total, symbol'))
                ->join('units', 'orders.unit_id', '=', 'units.id')
                ->whereTime($timeStart, $timeEnd)
                ->groupBy('units.symbol')
                ->get();
        return $a->all();
    }

    /**
     * Get total orders count
     *
     * @todo I hate that this is public for the decorators.
     *       Perhaps interface it?
     * @return int  Total articles
     */
    protected function totalOrders($all = false) {
        if (!$all) {
            return $this->order->where('status_id', 1)->count();
        }

        return $this->order->count();
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
