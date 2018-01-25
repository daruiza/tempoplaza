<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCluTypePaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clu_type_payment_method', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('type');   
            $table->string('description');           
            $table->string('data');  
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
        Schema::drop('clu_type_payment_method');
    }
}
