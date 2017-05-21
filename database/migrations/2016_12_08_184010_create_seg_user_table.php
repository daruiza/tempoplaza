<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('seg_user', function(Blueprint $table)
    	{
    		$table->increments('id');
    		$table->string('name')->unique();
    		$table->string('email')->unique();;
    		$table->string('password', 60);
    		$table->boolean('active')->default(true);
    		$table->boolean('login')->default(false);
            $table->string('stores')->default(env('APP_STORES',2));
            $table->string('products')->default(env('APP_PRODUCTS',120));
            $table->string('account')->default('basica');
    		$table->string('ip');
    		$table->integer('rol_id')->unsigned();
    		$table->rememberToken();
    		$table->timestamps();
    		$table->foreign('rol_id')->references('id')->on('seg_rol')->onDelete('cascade');           
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('seg_user');
    }
}
