<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('seg_city', function(Blueprint $table)
    	{
    		$table->increments('id');
    		$table->integer('code')->unique();
    		$table->string('city');    		
    		$table->integer('department_id')->unsigned();
    		$table->foreign('department_id')->references('id')->on('seg_department')->onDelete('cascade');
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
    	Schema::drop('seg_city');
    }
}
