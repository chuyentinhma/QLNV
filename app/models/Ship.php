<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Ship extends \Eloquent {

    use SoftDeletingTrait;
    // Add your validation rules here
    public static $rules = [
            // 'title' => 'required'
    ];
    // Don't forget to fill this array
    protected $fillable = [];
    protected $table = 'ships';
    protected $dates = ['deleted_at'];


    public function customer() {
         
        return $this->belongsTo('Customer');
    }
    
    public function user() {
        
        return $this->belongsTo('User');
    }

}
