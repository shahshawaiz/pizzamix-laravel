<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Size extends Model
{
    // table specifics
    protected $table = 'product_sizes';
	protected $fillable =  ['product_id', 'product_size', 'price'];    



    // relationships
	public function Product(){

		return $this->BelongsTo('App\Models\Product');
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
