<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCluStageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('clu_stage', function(Blueprint $table){
            $table->increments('id');
            $table->string('stage',60)->unique();
            $table->string('description');
            $table->boolean('active')->default(true);
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
         Schema::drop('clu_stage');
    }
}
