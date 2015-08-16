<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Kind extends \Eloquent {

    use SoftDeletingTrait;
    protected $table = 'kinds';
    // Add your validation rules here
    public static $rules = [
            // 'title' => 'required'
    ];
    // Don't forget to fill this array
    protected $fillable = [];
    protected $dates = ['deleted_at'];
    
    /**
     * Define one-to-many relationship
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function orders() {
        
        $this->hasMany('Order');
        
    }

}
