<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class News extends \Eloquent {

	// Add your validation rules here
        use SoftDeletingTrait;
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
        protected $dates = ['deleted_at'];

}