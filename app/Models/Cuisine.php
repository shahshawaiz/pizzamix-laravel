<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    // table specifics
    protected $table = 'cuisines';
	protected $fillable =  ['cuisineCode', 'name', 'description', 'thumbnail', 'header', 'headerstrip'];



	// relationships 
	public function Category(){

		return $this->hasMany('App\Models\Category');
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
