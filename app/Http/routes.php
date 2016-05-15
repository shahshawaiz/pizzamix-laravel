<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*--------------------------------------Post Controller---------------------------------*/


    Route::post('ajax/post_listing_item','ProductController@postListingItem');

    Route::post('ajax/get_product_items','ProductController@getProductItems');        
    Route::post('ajax/get_products_by_category','ProductController@getProductsByCategory');    
    Route::post('ajax/search_products','ProductController@getProductsByName');    

    Route::post('ajax/search_by_name', 'AdminController@searchByName');  
    Route::post('ajax/search_by_filter', 'AdminController@searchByFilter');   

    Route::post('image/upload', 'AdminController@imageUpload');    

/*--------------------------------------delete Controller---------------------------------*/
    Route::delete('cuisine/{id}', 'CuisineController@destroy'); 
    Route::delete('category/{id}', 'CategoryController@destroy'); 
    Route::delete('product/{id}', 'ProductController@destroy'); 
    Route::delete('item/{id}', 'ItemController@destroy');    
    Route::delete('order/product', 'OrderController@destroyProduct');    
    Route::delete('order/item', 'OrderController@destroyItem');            
    
Route::group(['middleware' => ['web']], function () {
    
    Route::post('ajax/updateStatus','AdminController@updateStatus');    
    Route::post('ajax/postOrder','OrderController@Store');
    Route::post('ajax/getPrice','OrderController@getPrice');
    Route::get('order/session','AdminController@getSession');

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
    

    /*-------------------------------------- Shared Controller---------------------------------*/

    Route::get('/', function () {
        return redirect('home');
    });

    Route::get('home', [
        'as' => 'home', 
        'uses' => 'SharedController@home'
    ]);

    Route::get('about', [
        'as' => 'about', 
        'uses' => 'SharedController@about'
    ]);

    Route::get('contact', [
        'as' => 'contact', 
        'uses' => 'SharedController@contact'
    ]);

    Route::get('500', [
        'as' => '500', 
        'uses' => 'SharedController@error500'
    ]);

    Route::get('404', [
        'as' => '404', 
        'uses' => 'SharedController@error404'
    ]);


    /*-------------------------------------- Admin Controller---------------------------------*/

    // Route::get('product_listing', [
    //     'as' => 'product_listing',
    //     'uses' => 'ProductController@req'
    // ]);  

    Route::get('test', [
        'as' => 'test',
        'uses' => 'ProductController@test'
    ]);  


    Route::get('admin/dashboard', [
        'as' => 'admin/dashboard',
        'uses' => 'AdminController@dashboard'
    ]);

    Route::get('admin/stats', [
        'as' => 'admin/stats', 
        'uses' => 'AdminController@getStatus'
    ]);    

    Route::get('admin/cuisine/create', [
        'as' => 'dashboard',
        'uses' => 'CuisineController@create'
    ]);

    Route::get('category/create', [
        'as' => 'dashboard',
        'uses' => 'CategoryController@create'
    ]);

    Route::get('product/create', [
        'as' => 'dashboard',
        'uses' => 'ProductController@create'
    ]);    

    Route::get('item/create/{type}', [
        'as' => 'item/create/{type}',
        'uses' => 'ItemController@create'
    ]);    

    Route::get('product/listing', [
        'as' => 'product/listing',
        'uses' => 'ProductController@listing'
    ]);    

    /*-------------------------------------- Buyer Controller---------------------------------*/

    Route::get('buyer/dashboard', [
        'as' => 'buyer/dashboard',
        'uses' => 'BuyerController@dashboard'
    ]);

    Route::get('product/{id}', [
        'as' => 'product/{id}', 
        'uses' => 'BuyerController@product'
    ]);

    Route::get('category/{id}', [
        'as' => 'category/{id}', 
        'uses' => 'SharedController@category'
    ]);    

    Route::get('cart', [
        'as' => 'cart',
        'uses' => 'BuyerController@getCart'
    ]);

    Route::get('checkout', [
        'as' => 'checkout',
        'uses' => 'BuyerController@checkout'
    ]);

    /*-------------------------------------- Kitchen Controller---------------------------------*/



    Route::get('kitchen/dashboard', [
        'as' => 'kitchen/dashboard',
        'uses' => 'KitchenController@dashboard'
    ]);    



    /*-------------------------------------- Security Controller---------------------------------*/        

    Route::post('register', [
        'as' => 'postRegister',
        'uses' => 'SecurityController@postRegister'
    ]);

    //login/logout routes
    Route::get('login', [
        'as' => 'login', 
        'uses' => 'SecurityController@getLogin'
    ]);

    Route::post('login', [
        'as' => 'postLogin',
        'uses' => 'SecurityController@postLogin'
    ]);

    Route::get('logout', [
        'as' => 'getLogout',
        'uses' => 'SecurityController@reset'
    ]);

    Route::get('reset', [
        'as' => 'reset',
        'uses' => 'SecurityController@reset'
    ]);    

    /*-------------------------------------- Restfull Controllers ---------------------------------*/

    Route::resource('cuisine', 'CuisineController');
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
    Route::resource('item', 'ItemController');
    Route::resource('product', 'ProductController');
    Route::resource('order', 'OrderController');    

});
