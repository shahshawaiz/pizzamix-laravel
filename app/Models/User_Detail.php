<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Detail extends Model
{
    // table specifics
	protected $table = 'user_details';
	protected $fillable =  [
    'user_id', 'address_1', 'address_2', 'address_3', 'cell_phone', 'approved_numbers', 'disapproved_orders', 'cancelled_orders'
    ];  


    // relationships
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