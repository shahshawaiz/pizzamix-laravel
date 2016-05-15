<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Status extends Model
{
  // table specifics
  protected $table = 'order_status';
  protected $fillable =  ['order_id', 'status', 'posted_at', 'approval_time', 'delivery_time'];

  // relationships 
	public function Order(){

		return $this->belongsTo('App\Models\Order');
	}	  

	// event listners
	public static function boot()
    {
        parent::boot();    
    
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function($category)
        {

        });
    }    	
    
}
