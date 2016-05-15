<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // table specifics
    protected $table = 'products';
	protected $fillable =  ['category_id', 'productCode', 'name', 'description', 'thumbnail', 'header', 'headerstrip'];



    // relationships
	public function Category(){

		return $this->belongsTo('App\Models\Category');
	}	

	public function Product_Size(){

		return $this->hasMany('App\Models\Product_Size');
	}	

	public function Product_Listing(){

		return $this->hasOne('App\Models\Product_Listing');
	}

	public function Order_Detail(){

		return $this->belongsTo('App\Models\Order_Detail');
	}	
	


    // event listeners
	public static function boot()
    {
        parent::boot();    
    
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function($category)
        {

        });
    }    			
  	
}
