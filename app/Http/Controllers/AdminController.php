<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Models;
use Khill\Lavacharts\Lavacharts;
use Cache;

use DB;
use Validator;
use Redirect;
use Session;

class AdminController extends Controller
{
 
    // ---------------------------------------- dashboard --------------------------------

	public function dashboard(){

		//check if admin
		(new SecurityController)->checkIfAdmin();

		//get all orders object with categorized requests
		$orders = $this->getOrders();
		   
		return view('pages.admin.home')->with('orders', $orders);
    }

	public function getOrders(){

		//orders and their status
		$pending_acknowledgments = $this->getOrdersByStatus(0);
		$acknowledged = $this->getOrdersByStatus(1);
		$approved = $this->getOrdersByStatus(2);
		$dispatched = $this->getOrdersByStatus(3);
		$delivered = $this->getOrdersByStatus(4);
		$disapproved = $this->getOrdersByStatus(5);
		$cancelled = $this->getOrdersByStatus(6);

		//object creeation with order status type as key 
		$orders = (object) array(
			'pending_acknowledgments' => $pending_acknowledgments,
			'acknowledged' => $acknowledged,
			'approved' => $approved,
			'dispatched' => $dispatched,
			'delivered' => $delivered,						
			'disapproved' => $disapproved,
			'cancelled' => $cancelled
		);

		return $orders;			
    }    

    public function getOrdersByStatus($status_id){

		// orders and their status
		// $orders = Models\Checkout::join('orders', 'orders.id', '=', 'checkouts.id')
  //                           ->join('order_status', 'orders.id', '=', 'order_status.order_id')
		// 				    ->join('users', 'orders.user_id', '=', 'users.id')
		// 				    ->selectraw('checkouts.id as order_id, checkouts.approval_time as approval_time, checkouts.delivery_time as delivery_time, checkouts.status as status')
		// 				    ->where('checkouts.user_id', Auth::user()->id );


		return $query = Models\Checkout::where('status', $status_id);
    }

    //update status
    public function updateStatus(Request $request){

        if($request->ajax()){
            		   
		   // increment status of current record
	   	   Models\Checkout::where('order_id', '=', $request->order_id)
	   	   	->update(array('status' => $request->order_status ));
	
		   return "Update status ajax request success. says AdminController.";
        }

        return "Update status ajax request failed. says AdminController.";

    }

    // ---------------------------------------- test --------------------------------
	public function test(){

		return view('pages.test');
	}

    // ---------------------------------------- session --------------------------------
    // get session details
    public function getSession(Request $request)
    {  
    	//temporory solution for cart decremention 
    	if($request->decrement_cart == 1){
            $cart_count = Session('cart_count');
            session( [ 'cart_count' => --$cart_count ] );    		
    	}

        $result = array();
        $result['order_id'] = Session('order_id');
        $result['cart_count'] = Session('cart_count');
        $result['user_id'] = Session('user_id');        

        return $result;
    }    



    // ---------------------------------------- image uploads --------------------------------	
	public function imageUpload(Request $request) {
	  
	  $file = array('image' => $request->file('image'));
	  $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
	  
	  // doing the validation, passing post data, rules and the messages
	  $validator = Validator::make($file, $rules);
	  
	  if ($validator->fails()) {
	    return Redirect::to('test');
	  }
	  else {
	    // checking file is valid.
	    if ($request->file('image')->isValid()) {

	      $destinationPath = public_path().'/images/uploads/'; 
	      $extension = $request->file('image')->getClientOriginalExtension(); 
	      $fileName = rand(11111,99999).'.'.$extension; 

	      $request->file('image')->move($destinationPath, $fileName);

	      return Redirect::to('test');
	    }
	    else {
	      return Redirect::to('test');
	    }
	  }
	}

    // ---------------------------------------- stats --------------------------------


    public function getStatus(){

   		$this::getLastWeekOrderStatus();
   		$this::getLastWeekSales();

    	return view('pages.admin.stats.index');
    }

    public function getLastWeekOrderStatus(){

		$order_status = Models\Order::join('order_status', 'orders.id', '=', 'order_status.order_id')
				    ->join('users', 'orders.user_id', '=', 'users.id')
				    ->groupby('status')
				    ->selectRaw('count(status) as count, status')->get();

		$votes  = \Lava::DataTable();

		$votes->addStringColumn('Status')
		      ->addNumberColumn('Order count');

		foreach($order_status as $item){

			if($item->status == 0 ){
				$votes->addRow(['Pending Acknowledgement', $item->count ]);
			}elseif($item->status == 1 ){
				$votes->addRow(['Acknowledged', $item->count ]);
			}else if($item->status == 2 ){
				$votes->addRow(['Approved', $item->count ]);
			}else if($item->status == 3 ){
				$votes->addRow(['Dispatched', $item->count ]);
			}else if($item->status == 4 ){
				$votes->addRow(['Delivered', $item->count ]);
			}else if($item->status == 5 ){
				$votes->addRow(['Disapproved', $item->count ]);
			}else if($item->status == 6 ){
				$votes->addRow(['Cancelled', $item->count ]);
			}				
			
		}

		\Lava::BarChart('Votes', $votes);

    }    


    public function getLastWeekSales(){

	 	$sales_record = Models\Order::groupby('timestamp_date')
								->selectRaw('sum(total_price) as sum, timestamp_date')->get();

    	$population = \Lava::DataTable();

		$population->addDateColumn('Date')
		           ->addNumberColumn('No. of orders');

		foreach($sales_record as $item){
			$population->addRow([$item->timestamp_date, $item->sum]);
		}


		\Lava::AreaChart('Population', $population, [
		    'title' => 'Sales Area chart'
		]);



	 	$sales_record = Models\Order::groupby('timestamp_date')
								->selectRaw('sum(total_price) as sum, timestamp_date')->get();

		//pie chart
		$population = \Lava::DataTable();

		$population->addDateColumn('Date')
		             ->addNumberColumn('No. of orders');

		foreach($sales_record as $item){
			$population->addRow([$item->timestamp_date, $item->sum]);
		}		             
		            
		\Lava::LineChart('LineChart', $population, [
		    'title' => 'Sales Line chart'
		]);
    }      


    // ---------------------------------------- product listing filter  --------------------------------
    public function searchByName(Request $request){
    	
           if($request->ajax()){

                switch ($request->item_type) {
                    case 1:
                        $table_name='cuisines';
                        $controller_name='cuisine';
                        $entity_type = 1;
                        break;
                    
                    case 2:
                        $table_name='categories';
                        $controller_name='category';
                        $entity_type = 2;
                        break;

                    case 3:
                        $table_name='products';
                        $controller_name='product';
                        $entity_type = 3;
                        break;

                    case 4:
                        $table_name='items';
                        $controller_name='item';
                        $entity_type = 4;
                        break;                                                
                }  

                switch ($request->query_string) {
                    case '':
                        $items = DB::table($table_name)->get();
                        break;
                    
                    default:
                        $items = DB::table($table_name)->where('name', 'LIKE', '%'.$request->query_string.'%' )->get(); 
                        break;
                }

	           $response = '';               
	           
	           foreach($items as $item){
	              $response = $response.
	              "
		              <div class='cart-content'>
		               <div class='cart-info'>
		               <div class='list-image'>
		                 <img  src='images/uploads/".$controller_name."/".$item->thumbnail."'>                
		               </div>	              
		                <div class='cart-info-part1'>
		                  <a href='".$controller_name.'/'.$item->id."'><h1>".$item->name."</h1></a>
		                  <p>".$item->description.".</p></div>
		                <div class='cart-info-part2'>

		                  <a href='' id='delete' data-toggle='modal' data-target='#confirmDelete' data-type='".$entity_type."' data-key='".$item->id."' data-toggle='tooltip' title='Delete'><span class='glyphicon glyphicon-trash'></span></a>

		                  <a href='".$controller_name.'/'.$item->id."' data-toggle='tooltip' title='Preview'><span class='glyphicon glyphicon-eye-open'></span></a>

		                  <a href='".$controller_name.'/'.$item->id."/edit' data-toggle='tooltip' title='Edit'><span class='glyphicon glyphicon-edit'></span></a>
		                </div>
		                <div class='cb'></div>
		              </div>
		              <div class='cb'></div>
		            </div>
	            ";
	        	}

	        	if($response == '')
	        		return "<h1>No results found!</h1>";
	        	else
		        	return $response;

           }else{
           	 return 0;
           }

    }

    public function searchByFilter(Request $request){
    	
           if($request->ajax()){

                switch ($request->item_type) {
                    case 1:
                        $table_name='cuisines';
                        $controller_name='cuisine';
                        $entity_type = 1;                        
                        break;
                    
                    case 2:
                        $table_name='categories';
                        $controller_name='category';
                        $filter_id = 'cuisine_id';
                        $entity_type = 2;                        
                        break;

                    case 3:
                        $table_name='products';
                        $controller_name='product';
                        $filter_id = 'category_id';
                        $entity_type = 3;
                        break;

                    case 4:
                        $table_name='items';
                        $controller_name='item';
                        $entity_type = 4;
                        break;                                                
                }  

                switch ($request->filter_id) {
                    case 0:
                        $items = DB::table($table_name)->get();
                        break;
                    
                    default:
                        $items = DB::table($table_name)->where($filter_id, '=', $request->filter_id)->get(); 
                        break;
                }

	           $response = '';               
	           
	           foreach($items as $item){
	              $response = $response.
	              "
		              <div class='cart-content'>
		               <div class='cart-info'>
		               <div class='list-image'>
		                 <img  src='images/uploads/".$controller_name."/".$item->thumbnail."'>                
		               </div>	              
		                <div class='cart-info-part1'>
		                  <a href='".$controller_name.'/'.$item->id."'><h1>".$item->name."</h1></a>
		                  <p>".$item->description.".</p></div>
		                <div class='cart-info-part2'>
		                  <a href='' id='delete' data-toggle='modal' data-target='#confirmDelete' data-type='".$entity_type."' data-key='".$item->id."' data-toggle='tooltip' title='Delete'><span class='glyphicon glyphicon-trash'></span></a>

		                  <a href='".$controller_name.'/'.$item->id."' data-toggle='tooltip' title='Preview'><span class='glyphicon glyphicon-eye-open'></span></a>

		                  <a href='".$controller_name.'/'.$item->id."/edit' data-toggle='tooltip' title='Edit'><span class='glyphicon glyphicon-edit'></span></a>
		                </div>
		                <div class='cb'></div>
		              </div>
		              <div class='cb'></div>
		            </div>
	            ";
	        	}

	        	if($response == '')
	        		return "<h1>No results found!</h1>";
	        	else
		        	return $response;

           }else{
           	 return 0;
           }

    }

    // ---------------------------------------- some other function --------------------------------    

}
