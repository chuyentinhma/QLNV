<?php
namespace Impl\Repo\Kind;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
interface KindInterface {
    
    /**
     * Get all Kinds
     * @return Array Arrayable collection
     */
    public function all();
    public function byPage($page=1, $limit=10);

    /**
     * Create a new Category
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
