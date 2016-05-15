<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Detail_Option extends Model
{
    // table specifics
    protected $table = 'order_details_options';
	protected $fillable =  ['order_detail_id', 'item_id', 'item_type', 'quantity', 'price'];    



	// relationships 
	public function Order_Detail(){

		return $this->belongsTo('App\Models\Order_Detail');
	}	  	

	public function Item(){

		return $this->hasMany('App\Models\Item');
	}



	// event listners
	public static function boot()
    {
        parent::boot();    
    
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleting(function($order_detail_option)
        {	
        	// skip if item is a default serving
       		if($order_detail_option->item_type != 4){
	        	//item's amount
	        	$amount = $order_detail_option->price;
				$order_detail_id = $order_detail_option->order_detail_id;
	           	$order_id = Order_Detail::where('id', '=', $order_detail_id)->firstorfail()->order_id;
	           	$order = Order::where('id', '=', $order_id)->firstorfail();           	
	            
	            //subtract amount from bill
	            $order->total_price = $order->total_price - $amount;
				$order->save();       			

       		}

        });

    }     		
}
