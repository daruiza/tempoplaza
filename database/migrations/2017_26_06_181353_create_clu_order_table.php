<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCluOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clu_order', function(Blueprint $table){
            $table->increments('id');
            $table->integer('number_order')->default(1);->unsigned();
            $table->dateTime('date');
            $table->string('name_client');
            $table->string('adress_client');
            $table->string('email_client');
            $table->string('number_client');
            $table->integer('resenia')->default(3);
            $table->string('resenia_test')->default('El servicio no fue ni bueno ni malo.');
            $table->boolean('resenia_active')->default(false);
            $table->integer('client_id')->unsigned();//para que el cliente pueda ver sus pedidos
            $table->boolean('active')->default(true);
            $table->integer('stage_id')->unsigned();
            $table->foreign('stage_id')->references('id')->on('clu_stage')->onDelete('cascade');
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
        Schema::drop('clu_order');
    }
}
