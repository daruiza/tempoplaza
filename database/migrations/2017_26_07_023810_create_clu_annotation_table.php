<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCluAnnotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clu_order_annotation', function(Blueprint $table){
            $table->increments('id');
            $table->string('user_name');//entrada de texto
            $table->dateTime('date');
            $table->string('description');//entrada de texto
            $table->boolean('active')->default(true);
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
        Schema::drop('clu_order_annotation');
    }
}
