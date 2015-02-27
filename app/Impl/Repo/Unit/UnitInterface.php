<?php namespace Impl\Repo\Unit;

interface UnitInterface {

    /**
     * Get all Units
     * @return Array Arrayable collection
     */
    public function all();

    /**
     * Get specific units
     * @param  int $id Units ID
     * @return object  Units object
     */
    public function byId($id);

    /**
     * Get specific units
     * @param  int $id Status slug
     * @return object  Status object
     */
    public function byStatus($status);
        /**
     * Create a new Order
     *
     * @param array  Data to create a new object
     * @return boolean
     */
    public function create(array $data);

    /**
     * Update an existing Article
     *
     * @param array  Data to update an Article
     * @return boolean
     */
    public function update(array $data);

}