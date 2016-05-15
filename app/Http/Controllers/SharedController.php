<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use JavaScript;

use App\Http\Requests;
use App\Models;
use Session;

class SharedController extends Controller
{
    
    // ---------------------------------------- home  --------------------------------    
    public function home(){

    	$cuisines = Models\Cuisine::where('id', '>=', 0)->get();
        $cuisines = $cuisines->sortByDesc('id');

        $products = Models\Product::where('id', '>=', 0)->take(4)->get();;
        $products = $products->sortByDesc('id');

        
        //initiate session cart count
        if( session('cart_count') == null ){
            session( ['cart_count' => 0 ] );
        }            


    	return view('pages.shared.home')->with('cuisines', $cuisines)
        ->with('products', $products);

    } 

    // ---------------------------------------- about  --------------------------------    
    public function about(){

        return view('pages.shared.about');

        ;
    } 

    // ---------------------------------------- contact  --------------------------------    
    public function contact(){

        return view('pages.shared.contact');
    }    

    // ---------------------------------------- error  --------------------------------    
    public function error404(){

        return view('errors.404');
    }  

    public function error500(){

        return view('errors.500');
    }                

    // ---------------------------------------- view category  --------------------------------    

    public function category($category_id){

       $products = Models\Product::where('category_id', $category_id)->get();
       $cagtegory_name = Models\Category::where('id', $category_id)->get()->first()->name;

       $cuisines = Models\Cuisine::where('id', '>', 0)->take(3)->get();

       return view('pages.shared.category')->with('products', $products)
       ->with('cuisines', $cuisines)->with('cagtegory_name', $cagtegory_name);
    }


}
