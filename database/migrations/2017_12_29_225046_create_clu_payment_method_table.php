<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCluPaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clu_payment_method', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('type');   
            $table->string('name');   
            $table->string('description');           
            $table->string('data');
            $table->string('form','2048');
            $table->boolean('active')->default(true); 
            $table->boolean('test')->default(true); 
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
        Schema::drop('clu_payment_method');
    }
}
