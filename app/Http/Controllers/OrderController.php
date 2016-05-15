<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models;
use App;

class OrderController extends Controller
{

    public function getPrice(Request $request){

        if($request->ajax()){

            $product_price = Models\Product_Size::where('id', $request->product_size_id)->first()->price;
            $timestamp =  $request->timestamp;
            
            return $product_price;
        }

        return "get price ajax request failed. says orderController.";
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        //check if variables request contains all paramters. else throw exception
        if( $request->product_size_id == null ||
            $request->product_quantity == null ){

            die("error-1");
        }


        //set user in session if logged in
        if( $request->session()->has('user_id') == null ){
            $user_id = null;
        }else{
            $user_id = Session('user_id');
        }

        //session cart count
        if( $request->session()->has('cart_count') == null ){
            session( ['cart_count' => 0 ] );
        }else{
            $cart_count = Session('cart_count');
        }

        if($request->ajax()){

            if( $request->session()->has('order_id') == null ){
                $request->session()->forget('order_id');

                //initiate main order record 
                $order = new Models\Order;
                $order->user_id = $user_id;     
                $order->timestamp_date = date ("Y-m-d");
                $order->timestamp_time = date("H:i:s");
                $order->total_price =  0.00;
                $order->save();

                session( ['order_id' => $order->id ] );  //session initiated
                session( ['cart_count' => ++$cart_count ] );  //session initiated                
                
                //initiate order status
                $order_status = new Models\Order_Status;
                $order_status->order_id = $order->id;
                $order_status->status = 0;      
                $order_status->posted_at = date('Y-m-d');                      
                $order_status->approval_time = null;
                $order_status->delivery_time = null;                
                $order_status->save();

            }
            else{
                $order = Models\Order::find(session('order_id')); //exsisting session retrieved   
                session( ['cart_count' => ++$cart_count ] );  //session initiated   

                // update userid in order if user has signed in later
                if( $user_id != null ){
                    $order->user_id = $user_id;     
                }         

            }


            //insert order details
            $order_detail = new Models\Order_Detail;
            $order_detail->order_id = $order->id;            
            $order_detail->product_id = $request->product_size_id; 
            $order_detail->quantity = $request->product_quantity;

                //retrieve actual product price
                $product_price = Models\Product_Size::where('id', $request->product_size_id)->first()->price;

            $order_detail->price = $product_price * $request->product_quantity;

            $order_detail->save();

            $order->total_price = $order_detail->price + $order->total_price;


            // //insert order options details

            //     //insert ingredients
                    if(isset($request->ingredients) != null){

                        foreach($request->ingredients as $ingredient){
                            $order_detail_options = new Models\Order_Detail_Option;
                            $order_detail_options->order_detail_id = $order_detail->id;
                            
                            $ingredient_detail = Models\Item::where('id', $ingredient)->first();

                            $order_detail_options->item_id = $ingredient_detail->id;
                            $order_detail_options->item_type = 1;
                            $order_detail_options->quantity = 1;
                            $order_detail_options->price = $order_detail_options->quantity * $ingredient_detail->price;                                  
 
                            $order_detail_options->save();  

                            $order->total_price = $order->total_price + $order_detail_options->price;               
                        }                    
                    }


            //     //insert accessories
                    if(isset($request->accessories) != null){ 

                        foreach($request->accessories as $accessory){
                            $order_detail_options = new Models\Order_Detail_Option;
                            $order_detail_options->order_detail_id = $order_detail->id;
                            
                            $accessory_detail = Models\Item::where('id', $accessory)->first();

                            $order_detail_options->item_id = $accessory_detail->id;
                            $order_detail_options->item_type = 2;
                            $order_detail_options->quantity = 1;
                            $order_detail_options->price = $order_detail_options->quantity * $accessory_detail->price ;                            

                            $order_detail_options->save();                   

                            $order->total_price = $order->total_price + $order_detail_options->price;  
                        }   

                    }  

            //     //insert accessories
                    if(isset($request->customOptions) != null){ 

                        foreach($request->customOptions as $customOption){
                            $order_detail_options = new Models\Order_Detail_Option;
                            $order_detail_options->order_detail_id = $order_detail->id;
                            
                            $customOption_detail = Models\Item::where('id', $customOption)->first();

                            $order_detail_options->item_id = $customOption_detail->id;
                            $order_detail_options->item_type = 3;
                            $order_detail_options->quantity = 1;
                            $order_detail_options->price = $order_detail_options->quantity * $customOption_detail->price;                            
 
                            $order_detail_options->save();         

                            $order->total_price = $order->total_price + $order_detail_options->price;            
                        }                
                    }

            //     //insert defaults
                    if(isset($request->defaults) != null){ 

                        foreach($request->defaults as $default){
                            $order_detail_options = new Models\Order_Detail_Option;
                            $order_detail_options->order_detail_id = $order_detail->id;
                            
                            $default_detail = Models\Item::where('id', $default)->first();

                            $order_detail_options->item_id = $default_detail->id;
                            $order_detail_options->item_type = 4;                            
                            $order_detail_options->quantity = 1;
                            $order_detail_options->price = $order_detail_options->quantity * $default_detail->price;                            
 
                            $order_detail_options->save();         

                            //$order->total_price = $order->total_price + $order_detail_options->price;            
                        }                
                    }                    

                //update order price changes
                $order->save();

            return "post order db insertion success. says orderController.";

        }

        return "post order ajax request failed. says orderController.";

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $order = Models\Order::join('checkouts', 'orders.id', '=', 'checkouts.order_id')
                    ->selectRaw('checkouts.user_id, checkouts.total_price, timestamp_date, timestamp_time')
                    ->where('checkouts.id', $id)
                    ->firstorfail();


        $order_products = Models\Order::join('checkouts', 'orders.id', '=', 'checkouts.order_id')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->join('product_sizes', 'product_sizes.id', '=', 'order_details.product_id')
                        ->join('products', 'products.id', '=', 'product_sizes.product_id')
                        ->selectRaw('order_details.product_id, name, quantity, product_sizes.price')
                        ->where('checkouts.id', $id)
                        ->get();


        $order_items = Models\Order::join('checkouts', 'orders.id', '=', 'checkouts.order_id')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->leftjoin('order_details_options', 'order_details.id', '=', 'order_details_options.order_detail_id')
                        ->leftjoin('product_sizes', 'product_sizes.id', '=', 'order_details.product_id')                        
                        ->leftjoin('products', 'products.id', '=', 'product_sizes.product_id')                     
                        ->leftjoin('items', 'items.id', '=', 'order_details_options.item_id')                        
                        ->selectRaw('orders.id as order_id, order_details.id as order_detail_id, products.id as product_id, order_details.quantity, product_sizes.price as product_price, products.name as product_name, products.thumbnail as product_image, products.thumbnail as product_thumbnail, item_id, item_type, items.name as item_name, items.price as item_price')                    
                        ->where('checkouts.id', $id)
                       ->get();

        $order_status = Models\Order::join('checkouts', 'orders.id', '=', 'checkouts.order_id')
                        ->join('order_status', 'orders.id', '=', 'order_status.order_id')
                        ->selectRaw('checkouts.status')
                        ->where('checkouts.id', $id)
                        ->firstorfail();

        $customer_details = App\User::join('user_details', 'users.id', '=', 'user_details.user_id')
                        ->selectRaw('name, email, username, address_1, address_2, address_3, cell_phone, approved_orders, disapproved_orders, cancelled_orders')
                        ->where('users.id', $order->user_id)
                        ->firstorfail();

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
                            break;

                        case 2:                        
                            $order_detail_items[$order_detail]['accessory'][$order_item->item_id] = $order_item;
                            break;
                    
                        case 3:
                            $order_detail_items[$order_detail]['sidedish'][$order_item->item_id] = $order_item;
                            break;
                        
                        case 4:
                            $order_detail_items[$order_detail]['default'][$order_item->item_id] = $order_item;  
                            break;

                        default:
                            break;                        
                    }
        
                    $order_detail_items[$order_detail]['quantity'] = $order_item->quantity; 
                    $order_detail_items[$order_detail]['product_id'] = $order_item->product_id;
                    $order_detail_items[$order_detail]['product_name'] = $order_item->product_name; 
                    $order_detail_items[$order_detail]['product_image'] = $order_item->product_image;
                    $order_detail_items[$order_detail]['product_price'] = $order_item->product_price;
                    
                }

            }                                   

        }

        return view('pages.admin.partials.order_detail')
            ->with('order', $order)
            ->with('status', $order_status)
            ->with('products', $order_products)
            ->with('customer', $customer_details)
            ->with('order_detail_items', $order_detail_items);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyProduct(Request $request)
    {           
        Models\Order_Detail::where('order_id', '=', $request->order_id)
                             ->where('product_id', '=', $request->product_id)
                             ->firstorfail()
                             ->delete();

        return "success";              
    }

    public function destroyItem(Request $request)
    {   
       $order_detail = Models\Order_Detail::where('order_id', '=', $request->order_id)
                             ->where('product_id', '=', $request->product_id)
                             ->get();
                             
        foreach($order_detail as $item){
            Models\Order_Detail_Option::where('order_detail_id', '=', $item->id)
                                        ->where('item_id', '=', $request->item_id)
                                        ->where('item_type', '=', $request->item_type)                                     
                                        ->firstorfail()
                                        ->delete();
        }

        return "success";        
    }  
  

}
