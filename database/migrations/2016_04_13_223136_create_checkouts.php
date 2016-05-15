<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckouts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('checkouts', function ($table) {

            $table->increments('id');
            $table->integer('order_id')->unsigned()->nullable();                   
            $table->integer('user_id')->unsigned()->nullable();       
            $table->float('total_price')->nullable(); 
            $table->tinyInteger('status')->nullable();
            $table->time('approval_time')->nullable();                         
            $table->time('delivery_time')->nullable();                                                        
            $table->timestamps();

            //status
            //0=Acknowdlegement Pending, 1=Acknowdleged, 2=Approved, 3=Dispatched, 4=Delivered, 5=Disapproved, 6=Canceled 

            //order will belonog to a user. one to many relationship       
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            //order will belonog to a user. one to many relationship       
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');            
        });         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('checkouts');        
    }
}
