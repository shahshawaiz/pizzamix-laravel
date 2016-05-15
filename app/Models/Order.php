<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // table specifics
    protected $table = 'orders';
	protected $fillable =  ['user_id', 'total_price', 'timestamp_date', 'timestamp_time'];



	// relationships 
	public function Order_Detail(){

		return $this->hasMany('App\Models\Order_Detail');
	}  

	public function Order_Status(){

		return $this->hasOne('App\Models\Order_Status');
	}  

	public function User(){

		return $this->belongsTo('App\User');
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
