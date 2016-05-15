<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;

class Order_Detail extends Model
{
    // table specifics
    protected $table = 'order_details';
	protected $fillable =  ['order_id', 'product_id', 'qunatity', 'price'];  

	// relationships 
	public function Order(){

		return $this->belongsTo('App\Models\Order');
	}	  

	public function Order_Detail_Options(){

		return $this->hasMany('App\Models\Order_Detail_Options');
	}	

	public function Product(){

		return $this->hasMany('App\Models\Product');
	}		

	// event listners
	public static function boot()
    {
        parent::boot();    
    
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleting(function($order_detail)
        {	

        	$id = $order_detail->id;
        	$order_id = $order_detail->order_id;

        	$amount = $order_detail->price; //amount to be deducted from bill

            $items = Order_Detail_Option::where('order_detail_id','=', $id)->get();
            
            foreach($items as $item){

            	//skip default serving
            	if($item->item_type != 4){
            		$amount = $amount + $item->price;
            	}
            	
            	//destroy item
            	Order_Detail_Option::destroy($item->id);            	
            } 

            // update billed amount in order
            $order = Order::find($order_id);
            $order->total_price = $order->total_price - $amount;
            $order->save();

            // check if order needs to be deleted and session needs to be flushed
            $order_count = Order_Detail::where('order_id', $order_id)->count();
            
            if($order_count == 1){
            	Order_Status::where('order_id', '=', $order_id)->firstorfail()->delete(); 
            	Order::destroy($order_id);

				Session::forget('order_id');
		   		Session::flush();
		   		Auth::logout();
            }

            
        });

    }    	
}
