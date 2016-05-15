<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // table specifics
    protected $table = 'items';
	protected $fillable =  ['itemCode', 'name', 'description', 'type', 'input_control', 'price', 'thumbnail' ];



	// relationships 
	public function Order_Detail_Option(){

		return $this->belongsTo('App\Models\Order_Detail_Option');
	}

	public function Product_Listing(){

		return $this->belongsTo('App\Models\Product_Listing');
	}	



	//event listners
	public static function boot()
    {
        parent::boot();    
    
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function($category)
        {

        });
    }    		
	

}
