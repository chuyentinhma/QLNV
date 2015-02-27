<?php

class OrdersPurpose extends \Eloquent {

    protected $table = 'orders_purposes';
    // Add your validation rules here
    public static $rules = [
            // 'title' => 'required'
    ];
    // Don't forget to fill this array
    protected $fillable = [];

}
