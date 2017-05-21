<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seg_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('action', 60);
			$table->string('description', 256);
			$table->date('date');			
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
        Schema::drop('seg_log');
    }
}
