<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItems extends Migration
{
    //table count: 1
        
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Items . i.e. ingridients, accessories, side_dishes
        Schema::create('items', function ($table) {

            $table->increments('id');
            $table->string('itemCode', 50)->unique()->nullable();            
            $table->string('name', 150)->nullable();            
            $table->text('description')->nullable();   
            $table->tinyInteger('type')->nullable(); //ingredient=1, accessories=2, custom options=3
            $table->tinyInteger('input_control')->nullable(); //textbox=1, checkbox=2           
            $table->float('price')->nullable();
            $table->string('thumbnail', 30)->nullable();

            $table->timestamps();

        });                

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //drop items
        Schema::drop('items');
    }
}
