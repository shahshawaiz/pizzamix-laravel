<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models;
use Auth;

class KitchenController extends Controller
{

    // ---------------------------------------- dashboard --------------------------------
	public function dashboard(){

        if( Auth::check() ){
            if(Auth::user()->accountType == 3 || Auth::user()->accountType == 1){
                $auth = true;
            }
            else{
	        	$message = "Unauthenticated access attempt detected. Any further attempts may result legal consequences.";
	            return view('pages.security.login')->with('message', $message);
            }

        }else{
        	$message = "Unauthenticated login access detected. Any further attempts may result legal consequences.";
            return view('pages.security.login')->with('message', $message);             
        }


		//get all orders object with categorized requests
		$orders = $this->getOrders();

		return view('pages.kitchen.home')->with('orders', $orders);
    }

	public function getOrders(){

		//orders and their status
        $orders = Models\Checkout::where('status','2' );						    
						    

		$orders = (object) array(
			'orders' => $orders,
		);

		return $orders;
			
    }    


    // update status
    public function updateStatus(Request $request){

        if($request->ajax()){
            
           $order_status = Models\Order_Status::find($request->order_id);
		   $status = $order_status->status;		   
		   $order_status->status = 4;
		   $order_status->save();

		   return "Update status ajax request success. says AdminController.";
        }

        return "Update status ajax request failed. says AdminController.";

    } 


    // ---------------------------------------- some other functions  --------------------------------    
}
