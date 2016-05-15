<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    // table specifics
    protected $table = 'checkouts';
	protected $fillable =  ['user_id', 'total_price', 'status', 'approval_time', 'delivery_time' ];


	// relationships 
	public function User(){

		return $this->belongsTo('App\User');
	}  	


	// event listners
	public static function boot()
    {
        parent::boot();    
    
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function($checkout)
        {

        });
    }    

}
