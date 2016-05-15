<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
{
    //table count: 3

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //products table. e.g. Napoli, Pisa
        Schema::create('products', function ($table) {

            $table->increments('id')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('productCode', 50)->unique()->nullable();
            $table->string('name', 150)->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail', 30)->nullable();
            $table->string('header', 30)->nullable();
            $table->string('headerstrip', 30)->nullable();                        
            $table->timestamps();

            //product will belonog to a category. many to one relationshio of product and category
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });       

        Schema::create('product_sizes', function ($table) {

            $table->increments('id');
            $table->integer('product_id')->unsigned()->nullable();             
            $table->tinyInteger('product_size')->nullable(); //1. Small 2. Medium 3. Large 4. Extra Large
            $table->float('price')->nullable();                           
            $table->timestamps();

            //product size will belonog to a product. one to one relationship
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onDelete('cascade');
        });         

        //products listing table
        Schema::create('product_listings', function ($table) {

            $table->increments('id');
            $table->integer('product_id')->unsigned()->nullable();   
            $table->integer('item_id')->unsigned()->nullable();                             
            $table->tinyInteger('item_type')->nullable(); //ingredient=1, accessories=2, custom options=3  , Default Serving=4          
            $table->timestamps();

            //product listing will belonog to a product. one to many relationship        
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            //item will belonog to a product listing. many to many relationship        
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
        ////products table. e.g. Napoli, Pisa
        Schema::drop('products');

        //product listings
        Schema::drop('product_sizes');      

        //product listings details
        Schema::drop('product_listings');           
    }
}
