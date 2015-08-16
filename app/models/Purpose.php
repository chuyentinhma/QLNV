<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Purpose extends \Eloquent {

    use SoftDeletingTrait;
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
    protected $dates = ['deleted_at'];
    
    /**
     * Define a many-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongToMany
     */
    public function orders() {
        
        return $this->belongsToMany('Order', 'orders_purposes', 'order_id', 'purpose_id')->withTimestamps();
    }

}
