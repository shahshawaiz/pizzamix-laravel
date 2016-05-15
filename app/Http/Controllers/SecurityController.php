<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use DB;
use App\Models;
use App;
use Hash;
use Input;
use Session;

class SecurityController extends Controller
{


	    public function getRegister(){

	   	 return view('pages.security.login');
	    }

	    public function postRegister(Request $request){

			$name = $request->name;
			$email = $request->email;
			$username = $request->username; 
			$password =  Hash::make( $request->password );  
			$accountType = $request->accountType;	

	    	//see if user exsists
	    	$emailExsists = DB::table('users')->where('email', $email)->first();
	    	$usernameExsists = DB::table('users')->where('username', $username)->first();

	    	if( isset($emailExsists) ){
	    		
	    		$message = 'Email already in use';
	    		$redirect = 'pages.security.login';	

	    	}elseif( isset($usernameExsists) ){
	    		
	    		$message = 'Username already in use';
	    		$redirect = 'pages.security.login';	

	    	}
	    	else{

				$user = new App\User();

		    	$user->email = $email;
		    	$user->username = $username;
		    	$user->password = $password;  	
		    	$user->name = $name;  			    	
		    	$user->accountType = 2;

		    	$user -> save();

				$user_detail = new Models\User_Detail();

		    	$user_detail->user_id = $user->id;
		    	$user_detail->address_1 = "To be filled.";
		    	$user_detail->address_2 = "To be filled.";
		    	$user_detail->address_3 = "To be filled.";
		    	$user_detail->cell_phone = "To be filled.";
		    	$user_detail->approved_orders = 0;
		    	$user_detail->disapproved_orders = 0;
		    	$user_detail->cancelled_orders = 0;

		    	$user_detail -> save();		    	

	        	$message = "Account creation success!";
	            return view('pages.security.login')->with('reg_message', $message);    

	    	}

    		return redirect('login');
	    }

	//login methods  
	    //get  
	    public function getLogin(){
	    	
	    	if( Auth::check() ){

				switch( Auth::user()->accountType ){
					case 1:
						return redirect('admin/dashboard');

					case 2:
						return redirect('buyer/dashboard');

					case 3:
						return redirect('kitchen/dashboard');
						
					default:			
			 	   		return redirect('/');	
				}
				
			}else{
		 	   	 return view('pages.security.login');
			}

	    }

	    //post
	    public function postlogin(Request $request){

			$email = $request->email;
			$password =  Hash::make( $request->password );  

			$credentials = $request->only('email', 'password');

			if(Auth::attempt($credentials)){

				//initate user session
				session( ['user_id' => Auth::user()->id ] );

		        //check if empty cart exsists. if not so then update their user_id
		        if( $request->session()->has('order_id') != null ){
		                $order = Models\Order::find(session('order_id'));
		                $order->user_id = session('user_id');
		                $order->save();
		        }

				switch( Auth::user()->accountType ){
					case 1:
						return redirect('admin/dashboard');

					case 2:
						return redirect('buyer/dashboard');

					case 3:
						return redirect('kitchen/dashboard');
						
					default:			
			 	   		return redirect('/');	
				}
				
			}else{
	        	$message = "Authentication failed! Incorrect credentials.";
	            return view('pages.security.login')->with('message', $message);    
			}

	    }

	    public function checkIfAdmin(){

if(null !== Auth::check())
	echo "1";
else
	echo "0";
die();
	    	if( Auth::check() ){
		        if( Auth::check()){
		            if(Auth::user()->accountType == 1){
		                $auth = true;
		            }
		            else{
			        	$message = "Unauthenticated access attempt detected. Any further attempts may result legal consequences.";
			            return redirect('pages.security.login')->with('message', $message);
		            }

		        }

	    	}else{
		        	$message = "Unauthenticated access attempt detected. Any further attempts may result legal consequences.";
		            return redirect('pages.security.login')->with('message', $message);            
	        }



	    }
	            
	   	public function reset(){

	   		// flush session and
			Session::forget('order_id');
			Session::forget('user_id');
			Session::forget('cart_count');						
	   		Session::flush();
	   		Auth::logout();
	   	 
	   	 	return redirect('/');
	    }

}
