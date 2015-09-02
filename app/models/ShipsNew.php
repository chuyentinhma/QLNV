<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ShipsNew extends \Eloquent {

    use SoftDeletingTrait;

    protected $fillable = [];
//    protected $table = 'ships';
    protected $dates = ['deleted_at'];

    public function customer() {

        return $this->belongsTo('Customer');
    }

    public function user() {

        return $this->belongsTo('User');
    }

}
