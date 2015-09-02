<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
class ShipsList extends \Eloquent {
    
    use SoftDeletingTrait;
    protected $fillable = [];
//    protected $table = 'shipslis';
    protected $dates = ['deleted_at'];
    
    public function user() {
        
        return $this->belongsTo('User');   
    }
    
    public function customer() {
        
        return $this->belongsTo('Customer');
    }
}