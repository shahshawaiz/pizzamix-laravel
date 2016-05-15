<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
    //table count: 2

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        //users
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('email', 100)->unique();
            $table->string('username', 30)->unique();
            $table->string('password');
            $table->tinyInteger('accountType'); // 1= admin, 2=Buyer, 3=Kitchen
            $table->rememberToken();
            $table->timestamps();
        });

        //user details
        Schema::create('user_details', function ($table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();                         
            $table->text('address_1')->nullable();
            $table->text('address_2')->nullable();
            $table->text('address_3')->nullable();                        
            $table->string('cell_phone', 30)->nullable();                         
            $table->integer('approved_orders')->nullable();
            $table->integer('disapproved_orders')->nullable();                                     
            $table->integer('cancelled_orders')->nullable();                                                 

            $table->timestamps();

            //product listing will belonog to a product. one to one relationship
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });      

        Schema::table('sessions', function($table)
        {
            $table->integer('user_id')->unsigned()->nullable()->change();            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });       

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //users
        Schema::drop('users');

        //user details
        Schema::drop('user_details');
    }
}


