<?php

class Customer extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';
    
    // Add your validation rules here
    public static $rules = [
            // 'title' => 'required'
    ];
    // Don't forget to fill this array
    protected $fillable = [
        'phone_number',
        'status'
    ];
    
    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order() {
        
        return $this->belongsTo('Order');
        
    }
    
    public function ships() {
       
        return $this->hasMany('Ship');
    }
}
