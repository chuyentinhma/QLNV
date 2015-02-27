<?php

class Purpose extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'purposes';
    
    // Add your validation rules here
    public static $rules = [
            // 'title' => 'required'
    ];
    // Don't forget to fill this array
    protected $fillable = [];
    
    /**
     * Define a many-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongToMany
     */
    public function orders() {
        
        return $this->belongsToMany('Order', 'orders_purposes', 'order_id', 'purpose_id')->withTimestamps();
    }

}
