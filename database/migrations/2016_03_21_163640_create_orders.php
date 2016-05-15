<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrders extends Migration
{
    //table count: 4

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //order table
        Schema::create('orders', function ($table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();       
            $table->float('total_price')->unsigned()->nullable(); 
            $table->date('timestamp_date')->nullable();      
            $table->time('timestamp_time')->nullable();                                                       
            $table->timestamps();

            //order will belonog to a user. one to many relationship       
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        }); 

        //order status  
        //order status table
        Schema::create('order_status', function ($table) {

            $table->increments('id');
            $table->integer('order_id')->unsigned()->nullable();                 
            $table->tinyInteger('status')->nullable();
            $table->string('posted_at', 20)->nullable();
            $table->time('approval_time')->nullable();                         
            $table->time('delivery_time')->nullable();                         
            $table->timestamps();

            //status
            //0=Acknowdlegement Pending, 1=Acknowdleged, 2=Approved, 3=Dispatched, 4=Delivered, 5=Disapproved, 6=Canceled by customer

            //product listing will belonog to a product. one to one relationship         
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });                            


        //order details
        Schema::create('order_details', function ($table) {

            $table->increments('id');
            $table->integer('order_id')->unsigned()->nullable(); 
            $table->integer('product_id')->unsigned()->nullable(); //note that this id refers to product size id                                        
            $table->tinyInteger('quantity')->nullable();
            $table->float('price')->nullable();          
            $table->timestamps();

            //orders will belong to order details. one to one relationship
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            //products will belong to order details. many to one relationship
            $table->foreign('product_id')->references('id')->on('product_sizes')->onDelete('cascade');               

        });   


        //order detail options
        Schema::create('order_details_options', function ($table) {

            $table->increments('id');
            $table->integer('order_detail_id')->unsigned()->nullable();   
            $table->integer('item_id')->unsigned()->nullable();                                 
            $table->tinyInteger('item_type')->nullable(); //ingredient=1, accessories=2, custom options=3  , Default Serving=4          
            $table->integer('quantity')->nullable();
            $table->float('price')->nullable();            
            $table->timestamps();

            //order details options will belong to order details. many to one relation
            $table->foreign('order_detail_id')->references('id')->on('order_details');  

            //items will belong to order detail options. many to many relation
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');  
        });      


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //order
        Schema::drop('orders');

        //order status
        Schema::drop('order_status');

        //order details
        Schema::drop('order_details');

        //order detail options
        Schema::drop('order_details_options');
    }
}
