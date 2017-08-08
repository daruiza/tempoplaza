<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCluProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('clu_products', function(Blueprint $table)
    	{
    		$table->increments('id');
            $table->string('name',60)->unique();
    		$table->integer('price')->nullable();
            $table->string('category')->nullable();
            $table->string('unity_measure')->nullable();
            $table->string('colors')->nullable();
            $table->string('sizes')->nullable(); 
            $table->string('flavors')->nullable();
            $table->string('materials')->nullable();
            $table->string('models')->nullable();
            $table->string('description')->nullable();            
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('order')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('store_id')->unsigned();
    		$table->foreign('store_id')->references('id')->on('clu_store')->onDelete('cascade');
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
    	Schema::drop('clu_products');
    }
}
