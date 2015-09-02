<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Customer extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletingTrait;
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
    protected $dates = ['deleted_at'];


    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order() {
        
        return $this->belongsTo('Order');
        
    }
    
    public function shipsNews() {
       
        return $this->hasMany('ShipsNew');
    }
    
    public function shipsLists() {
        
        return $this->hasOne('ShipsList');
    }
}
