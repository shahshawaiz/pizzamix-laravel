<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models;
use Auth;

class BuyerController extends Controller
{

    // ---------------------------------------- dashboard --------------------------------
	public function dashboard(){

        if( Auth::check() ){
            if(Auth::user()->accountType == 2 || Auth::user()->accountType == 1){
                $auth = true;
            }
            else{
                $message = "Unauthenticated access attempt detected. Any further attempts may result legal consequences.";
                return view('pages.security.login')->with('message', $message); 
            }

        }else{
            $message = "Unauthenticated access attempt detected. ";
            return view('pages.security.login')->with('message', $message);             
        }



		//get all orders object with categorized requests
		$orders = $this->getOrders();

		return view('pages.buyer.home')->with('orders', $orders);
    }

	public function getOrders(){
        
        $orders = Models\Checkout::where('checkouts.user_id', Auth::user()->id );

		$orders = (object) array(
			'orders' => $orders,
		);

		return $orders;
			
    }    

    public function updateStatus(Request $request){


        if($request->ajax()){
            
           Models\Checkout::where('order_id', '=', $request->order_id)
            ->update(array('status' => $request->order_status ));

		   return "Update status ajax request success. says AdminController.??";
        }

        return "Update status ajax request failed. says AdminController.";

    }



    // ---------------------------------------- product order  --------------------------------    
    public function product($product_id){

        //retrieve main products object
    	$product = Models\Product::where('id', $product_id)->first();

        $product_id = $product->id; //product id

        //get product size
        $product_size = Models\Product_Size::where('product_id', $product_id)->get();

        //initialize arrray for storing list of ingredients, accessories and custom orders
        $ingredients = array();
        $accessories = array();
        $custom_orders = array();
        $defaults = array();        

        //get product listing of given product 
        $product_listing = Models\Product_Listing::where('product_id', $product_id)->get();
        
        //if no product listing exsists skip all steps
        if($product_listing != null){

            foreach($product_listing as $item){

                $item_id = $item->item_id;
                $item_type = $item->item_type;

                switch ($item_type) {
                    case 1:
                       $ingredient = Models\Item::where('id', $item_id)->first();
                       array_push($ingredients, $ingredient);

                       break;

                    case 2:
                       $accessory = Models\Item::where('id', $item_id)->first();
                       array_push($accessories, $accessory);

                       break;

                    case 3:
                       $custom_order = Models\Item::where('id', $item_id)->first();
                       array_push($custom_orders, $custom_order);

                       break;

                    case 4:
                       $default = Models\Item::where('id', $item_id)->first();
                       array_push($defaults, $default);

                       break;

                    default:
                        # code...
                        break;
                }
                        
            }

        }

        //retrieve all cuisines for sidebar
        $cuisines = Models\Cuisine::where('id', '>', 0)->get();
    
        //return all variables
        return view('pages.buyer.product') ->with('product', $product)
                                            ->with('product_size', $product_size)
                                            ->with('ingredients', $ingredients)
                                            ->with('accessories', $accessories)
                                            ->with('custom_orders', $custom_orders)
                                            ->with('defaults', $defaults)
                                            ->with('cuisines', $cuisines);

    }    

    // ---------------------------------------- cart --------------------------------    
    public function getCart(Request $request){

        if( $request->session()->has('order_id') == null ){
            $order_id = null;
        }else{
            $order_id = Session('order_id');
        }
                
        $order = Models\Order::selectRaw('user_id, total_price, timestamp_date, timestamp_time')
                    ->where('orders.id', $order_id)->get()->first();

        $order_products = Models\Order::join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->join('product_sizes', 'product_sizes.id', '=', 'order_details.product_id')
                        ->join('products', 'products.id', '=', 'product_sizes.product_id')
                        ->selectRaw('order_details.product_id, name, quantity, product_sizes.price')
                        ->where('orders.id', $order_id)
                        ->get();


        $order_items = Models\Order::join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->leftjoin('order_details_options', 'order_details.id', '=', 'order_details_options.order_detail_id')
                        ->join('product_sizes', 'product_sizes.id', '=', 'order_details.product_id')                        
                        ->join('products', 'products.id', '=', 'product_sizes.product_id')                     
                        ->leftjoin('items', 'items.id', '=', 'order_details_options.item_id')                        
                        ->selectRaw('orders.total_price as total_price, orders.id as order_id, order_details.id as order_detail_id, product_sizes.id as product_id, order_details.quantity, product_sizes.price as product_price, products.name as product_name, products.thumbnail as product_thumbnail, item_id, item_type, items.name as item_name, items.price as item_price')                    
                        ->where('orders.id', $order_id)
                       ->get();

        $categories = Models\Category::where('id','>',0)->get();

        // get product-customization related object for order detail
        $order_details = array();

        foreach($order_items as $order_item){
            if(!in_array($order_item->order_detail_id, $order_details, true)){
                array_push($order_details, $order_item->order_detail_id);
            }
        }

        $order_detail_items = array();
        foreach($order_details as $order_detail){

            foreach($order_items as $order_item){

                if($order_detail == $order_item->order_detail_id){
                    switch ($order_item['item_type']) {
                        case 1:
                            $order_detail_items[$order_detail]['ingredient'][$order_item->item_id] = $order_item;
                            $order_detail_items[$order_detail]['ingredient'][$order_item->item_id]['type'] = "Ingredient"; 
                            break;

                        case 2:                        
                            $order_detail_items[$order_detail]['accessory'][$order_item->item_id] = $order_item;
                            $order_detail_items[$order_detail]['accessory'][$order_item->item_id]['type'] = "Accessory";  
                            break;
                    
                        case 3:
                            $order_detail_items[$order_detail]['sidedish'][$order_item->item_id] = $order_item;
                            $order_detail_items[$order_detail]['sidedish'][$order_item->item_id]['type'] = "Side Dish";
                            break;
                        
                        case 4:
                            $order_detail_items[$order_detail]['default'][$order_item->item_id] = $order_item; 
                            $order_detail_items[$order_detail]['default'][$order_item->item_id]['type'] = "Default Serving";
                            break;
                    }

                    $order_detail_items[$order_detail]['product_id'] = $order_item->product_id;
                    $order_detail_items[$order_detail]['product_name'] = $order_item->product_name;
                    $order_detail_items[$order_detail]['quantity'] = $order_item->quantity;                       
                    $order_detail_items[$order_detail]['product_price'] = $order_item->product_price;
                    $order_detail_items[$order_detail]['product_thumbnail'] = $order_item->product_thumbnail;
                    $order_detail_items[$order_detail]['sub_total'] = $order_item->quantity*$order_item->product_price;
                    
                    $total_price = $order_item->total_price;                                              
                }

            }                                   

        }

        if(isset($order_item) == null)
            $total_price=0;

        return view('pages.buyer.cart') 
            ->with('order', $order)
            ->with('products', $order_products)
            ->with('order_detail_items', $order_detail_items)
            ->with('total_price', $total_price)
            ->with('categories', $categories);
    }

    // ---------------------------------------- cart --------------------------------    
    public function checkout(){

        if( Auth::check() ){
            

            $order = Models\Order::join('order_status', 'orders.id', '=', 'order_status.order_id')
                                        ->where('orders.id', '=', session('order_id') )
                                        ->selectRaw('orders.id as order_id, user_id, total_price, status, approval_time, delivery_time')
                                        ->firstorfail();

            $checkout = new Models\Checkout;
            $checkout->order_id = $order->order_id;            
            $checkout->user_id = $order->user_id;
            $checkout->total_price = $order->total_price;
            $checkout->status = $order->status;
            $checkout->approval_time = $order->approval_time;
            $checkout->delivery_time = $order->delivery_time;

            $checkout->save();
        
            Session()->forget('order_id');      
            Session()->forget('cart_count');                        
            return redirect('buyer/dashboard');            
        }else{
             return view('pages.security.login');
        }

    }



}
