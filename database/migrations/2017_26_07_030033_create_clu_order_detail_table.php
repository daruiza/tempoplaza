<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCluOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clu_order_detail', function(Blueprint $table){
            $table->increments('id');            
            $table->string('product');
            $table->integer('price');
            $table->integer('volume');
            $table->string('description');//caracteristicas
            $table->integer('product_id')->unsigned(); 
            $table->integer('order_id')->unsigned();            
            $table->foreign('order_id')->references('id')->on('clu_order')->onDelete('cascade');            
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
        Schema::drop('clu_order_detail');
    }
}
