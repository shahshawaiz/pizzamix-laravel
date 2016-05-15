<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuisinesCategories extends Migration
{
    //table count: 2
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //cuisine table. e.g. Italin, Chineese.
           Schema::create('cuisines', function ($table) {

            $table->increments('id')->nullable();
            $table->string('cuisineCode', 50)->unique()->nullable();
            $table->string('name', 150)->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail', 30)->nullable();
            $table->string('header', 30)->nullable();
            $table->string('headerstrip', 30)->nullable();                        
            $table->timestamps();

        });

        //category table. e.g. Pizza and Pasta.
        Schema::create('categories', function ($table) {

            $table->increments('id')->nullable();
            $table->integer('cuisine_id')->unsigned()->nullable();            
            $table->string('categoryCode', 50)->unique()->nullable();
            $table->string('name', 150)->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail', 30)->nullable();
            $table->string('header', 30)->nullable();
            $table->string('headerstrip', 30)->nullable();                        
            $table->timestamps();

            //category will belonog to a cuisine. many to one relationshio of category and cuisine
            $table->foreign('cuisine_id')->references('id')->on('cuisines')->onDelete('cascade');

        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //cuisines
        Schema::drop('cuisines');

        //categories
        Schema::drop('categories');                
    }
}
