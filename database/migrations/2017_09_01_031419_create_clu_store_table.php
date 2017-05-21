<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCluStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('clu_store', function(Blueprint $table)
    	{
    		$table->increments('id');
            $table->string('name',60)->unique();
    		$table->integer('nit')->nullable();
            $table->string('department')->nullable();
            $table->string('city')->nullable();
            $table->string('adress')->nullable(); 
            $table->string('description')->nullable();
            $table->string('ubication',512)->nullable();
            $table->string('image')->nullable();
            $table->string('banner')->nullable();
            $table->string('color_one')->nullable();
            $table->string('color_two')->nullable();
            $table->string('status')->nullable();
            $table->integer('order')->nullable();
            $table->string('metadata')->nullable();
            $table->string('web')->nullable();
            $table->string('fanpage')->nullable();
            $table->string('movil')->nullable();                                  
    		$table->integer('user_id')->unsigned();
    		$table->foreign('user_id')->references('id')->on('seg_user')->onDelete('cascade');
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
    	Schema::drop('clu_store');
    }
}
