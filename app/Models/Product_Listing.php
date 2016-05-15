<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Listing extends Model
{
    // table specifics
    protected $table = 'product_listings';
	protected $fillable =  ['product_id', 'item_id', 'item_type']; 



    // relationships
	public function Product(){

		return $this->belongsTo('App\Models\Product');
	}		

	public function Item(){

		return $this->hasMany('App\Models\Item');
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

