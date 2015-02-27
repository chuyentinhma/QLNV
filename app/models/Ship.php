<?php

class Ship extends \Eloquent {

    // Add your validation rules here
    public static $rules = [
            // 'title' => 'required'
    ];
    // Don't forget to fill this array
    protected $fillable = [];
    protected $table = 'ships';
    
    public function customer() {
         
        return $this->belongsTo('Customer');
    }
    
    public function user() {
        
        return $this->belongsTo('User');
    }

}
