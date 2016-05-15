<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Product;
use App\Models\Category;
use App\Models\Product_Size;
use App\Models\Item;
use App\Models\Product_Listing;
use App\Models\Product_Listing_Detail;

class ProductController extends Controller
{
    public function test()
    {
        $categories = Category::lists('name', 'id');
        $categories->prepend('None');     

        $products = Product::where('id','>', '0')->get();

        return view('pages.test')->with('categories', $categories)->with('products', $products);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //check if admin
        (new SecurityController)->checkIfAdmin();

        $categories = Category::lists('name', 'id');
        $categories->prepend('None');     

        $products = Product::where('id','>', '0')->get();

        return view('pages.admin.products.index')->with('categories', $categories)->with('products', $products);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //check if admin
        (new SecurityController)->checkIfAdmin();

        $categories = Category::lists('name','id');
        
        return view('pages.admin.products.add')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;

        $product->name = $request->name;
        $product->description = $request->description; 
        $product->category_id = $request->category_id;
        $product->save();

        //file upload options
        $destination = public_path().'/images/uploads/product/';
        $base_code = 'product-'.$product->id;

        //update id specific columns
        $product->productCode = $base_code;

        $product->save();     

        //insert product sizzes
        $product_prices = $request->product_prices;

        $temp_count=0;
        foreach($product_prices as $item){
            $product_size = new Product_Size;

            $product_size->product_id = $product->id;
            $product_size->product_size = $temp_count+1;   
            $product_size->price = $product_prices[$temp_count];

            $product_size->save();   

            $temp_count++;
        }

        //file optreations
        if($request->file('thumbnail')!=null){

            $file_thumnail = $request->file('thumbnail');
            $product->thumbnail = $base_code . '-thumbnail.'. $file_thumnail->getClientOriginalExtension();

            $product->save();  

            $file_thumnail->move(
                $destination , 
                $base_code . '-thumbnail.' . $file_thumnail->getClientOriginalExtension()
            );

        }

        if($request->file('header')!=null){

            $file_header = $request->file('header');
            $product->header = $base_code . '-header.'. $file_header->getClientOriginalExtension();

            $product->save();  

            $file_header->move(
                $destination , 
                $base_code . '-header.' . $file_header->getClientOriginalExtension()
            );

        }                 

        if($request->file('headerStrip')!=null){

            $file_header_strip = $request->file('headerStrip');
            $product->headerStrip = $base_code . '-headerStrip.'. $file_header_strip->getClientOriginalExtension();

            $product->save();  

            $file_header_strip->move(
                $destination , 
                $base_code . '-headerStrip.' . $file_header_strip->getClientOriginalExtension()
            );

        }     

            
       return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //check if admin
        (new SecurityController)->checkIfAdmin();

        return redirect('product/'.$id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        //check if admin
        (new SecurityController)->checkIfAdmin();

        $product = Product::find($id);
        $categories = Category::lists('name','id');

        return view('pages.admin.products.edit')->with('product', $product)->with('categories', $categories );
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

        $product = Product::find($id);

        $product->name = $request->name;
        $product->description = $request->description; 
        $product->category_id = $request->category_id;
        $product->save();

        //file upload options
        $destination = public_path().'/images/uploads/product/';
        $base_code = 'product-'.$product->id;

        //update id specific columns
        $product->productCode = $base_code;

        $product->save();     

        // //insert product sizzes
        // $product_prices = $request->product_prices;


        // $temp_count=0;

        // foreach($product_prices as $item){
        //     $product_size = Product_Size::find($id);

        //     $product_size->product_id = $product->id;
        //     $product_size->product_size = $item;   
        //     $product_size->price = $product_prices[$temp_count];

        //     $product_size->save();   

        //     $temp_count++;
        // }

        //file optreations
        if($request->file('thumbnail')!=null){

            $file_thumnail = $request->file('thumbnail');
            $product->thumbnail = $base_code . '-thumbnail.'. $file_thumnail->getClientOriginalExtension();

            $product->save();  

            $file_thumnail->move(
                $destination , 
                $base_code . '-thumbnail.' . $file_thumnail->getClientOriginalExtension()
            );

        }

        if($request->file('header')!=null){

            $file_header = $request->file('header');
            $product->header = $base_code . '-header.'. $file_header->getClientOriginalExtension();

            $product->save();  

            $file_header->move(
                $destination , 
                $base_code . '-header.' . $file_header->getClientOriginalExtension()
            );

        }                 

        if($request->file('headerStrip')!=null){

            $file_header_strip = $request->file('headerStrip');
            $product->headerStrip = $base_code . '-headerStrip.'. $file_header_strip->getClientOriginalExtension();

            $product->save();  

            $file_header_strip->move(
                $destination , 
                $base_code . '-headerStrip.' . $file_header_strip->getClientOriginalExtension()
            );

        }    
            

       return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Product_Size::where('product_id', '=', $id)->delete();
       Product::find($id)->delete();

        return 'cuisine destroy success';
    }

    //------------------------------------------- 

    public function listing(){
        //check if admin
        (new SecurityController)->checkIfAdmin();
        
        $products = Product::lists('name','id');
        $ingredients = Item::where('type', 1)->lists('name','id');
        $accessories = Item::where('type', 2)->lists('name','id');
        $sideDishes = Item::where('type', 3)->lists('name','id');        
        $defaults = Item::lists('name','id');        

        return view('pages.admin.products.listing')->with('products', $products)
        ->with('ingredients', $ingredients)->with('accessories', $accessories)
        ->with('sideDishes', $sideDishes)->with('defaults', $defaults);
    }


    public function postListingItem(Request $request){

        if($request->ajax()){

            if($request->product_id==null || $request->item_id==null)
                return "null product or item";          

            $product_listing = new Product_Listing;
            $product_listing->product_id = $request->product_id;
            $product_listing->item_id = $request->item_id;
            $product_listing->item_type = $request->item_type;            
            $product_listing->save();

           return "insert ajax request success. says ProductController.";
        }

        return "insert ajax request failed. says ProductController";

    }

    public function getProductItems(Request $request){

        if($request->ajax()){

           $items = Product_Listing::where('product_id', '=', $request->product_id)->get();

           $ingredients = '';
           $accessories = '';
           $sideDishes = '';  
           $defaults = '';                    
           
           foreach($items as $item){
               $item_type = $item->item_type;

               $item_detail = Item::where('id', $item->item_id)->get()->first();

               switch($item_type){
                    case 1:
                        $ingredients = $ingredients.'<p>'.$item_detail->name.'</p>';
                        break;

                    case 2:
                       $accessories = $accessories.'<p>'.$item_detail->name.'</p>';
                       break;

                    case 3:
                       $sideDishes = $sideDishes.'<p>'.$item_detail->name.'</p>'; 
                       break;                         

                    case 4:
                       $defaults = $defaults.'<p>'.$item_detail->name.'</p>';
                       break;  
                       
                    default:
                        break;

               }
           }

          $return_items = array($ingredients, $accessories, $sideDishes, $defaults);

          return $return_items;

        }
        return "insert ajax request failed. says ProductController";
    }
    

    public function getProductsByCategory(Request $request){
       
           if($request->ajax()){

                switch ($request->category_id) {
                    case 0:
                        $products = Product::where('id', '>', '0')->get(); 
                        break;
                    
                    default:
                        $products = Product::where('category_id', '=', $request->category_id)->get();  
                        break;
                }

           $response = '';               
           
           foreach($products as $item){

                $response = $response.
              "
              <div class='cart-content'>
              <img src='images/cart-image.jpg'>
              <div class='cart-info'>
                <div class='cart-info-part1'>
                  <a href='{{ route('product.show', ".$item->id." ) }}'><h1>".$item->name."</h1></a>
                  <p>".$item->description.".</p>

                    <h2><span>PRICE:</span>Kr ".$item->Product_Size->get(0)->price."-/</h2>

                </div>
                <div class='cart-info-part2'>
                  <a href='{{ route('product.destroy', ".$item->id." ) }}' data-toggle='tooltip' title='Delete'><span class='glyphicon glyphicon-trash'></span></a>

                  <a href='{{ route('product.show', ".$item->id." ) }}' data-toggle='tooltip' title='Preview'><span class='glyphicon glyphicon-eye-open'></span></a>

                  <a href='{{ route('product.edit', ".$item->id." ) }}' data-toggle='tooltip' title='Edit'><span class='glyphicon glyphicon-edit'></span></a>
                </div>
                <div class='cb'></div>
              </div>
              <div class='cb'></div>
            </div>
            ";

           }

           return $response;
            
        }else{
            return 0;
        }

    }

    public function getProductsByName(Request $request){
       
           if($request->ajax()){

                switch ($request->query_string) {
                    case '':
                        $products = Product::where('id', '>', '0')->get(); 
                        break;
                    
                    default:
                        $products = Product::where('name', 'LIKE', '%'.$request->query_string.'%' )->get();  
                        break;
                }

           $response = '';               
           
           foreach($products as $item){

                $response = $response.
              "
              <div class='cart-content'>
              <img src='images/cart-image.jpg'>
              <div class='cart-info'>
                <div class='cart-info-part1'>
                  <a href='{{ route('product.show', ".$item->id." ) }}'><h1>".$item->name."</h1></a>
                  <p>".$item->description.".</p>

                    <h2><span>PRICE:</span>Kr ".$item->Product_Size->get(0)->price."-/</h2>

                </div>
                <div class='cart-info-part2'>
                  <a href='{{ route('product.destroy', ".$item->id." ) }}' data-toggle='tooltip' title='Delete'><span class='glyphicon glyphicon-trash'></span></a>

                  <a href='{{ route('product.show', ".$item->id." ) }}' data-toggle='tooltip' title='Preview'><span class='glyphicon glyphicon-eye-open'></span></a>

                  <a href='{{ route('product.edit', ".$item->id." ) }}' data-toggle='tooltip' title='Edit'><span class='glyphicon glyphicon-edit'></span></a>
                </div>
                <div class='cb'></div>
              </div>
              <div class='cb'></div>
            </div>
            ";

           }

           return $response;
            
        }else{
            return 0;
        }

    }




}
