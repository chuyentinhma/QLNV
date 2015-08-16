<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class OrdersPurpose extends \Eloquent {

    use SoftDeletingTrait;
    protected $table = 'orders_purposes';
    // Add your validation rules here
    public static $rules = [
            // 'title' => 'required'
    ];
    // Don't forget to fill this array
    protected $fillable = [];
    protected $dates = ['deleted_at'];

}
