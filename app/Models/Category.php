<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // table specifics
    protected $table = 'categories';
	protected $fillable =  ['cuisine_id', 'categoryCode', 'name', 'description', 'thumbnail', 'header', 'headerstrip'];   



	// relationships 
	public function Cuisine(){

		return $this->belongsTo('App\Models\Cuisine');
	}

	public function Product(){

		return $this->hasMany('App\Models\Product');
	}	



    //event listenrs
	public static function boot()
    {
        parent::boot();    
    
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function($category)
        {

        });
    }    	

}
