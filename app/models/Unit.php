<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Unit extends \Eloquent {
    
        use SoftDeletingTrait;
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
        protected $dates = ['deleted_at'];
        
        public function orders() {
            return $this->hasMany('Order');
        }

}