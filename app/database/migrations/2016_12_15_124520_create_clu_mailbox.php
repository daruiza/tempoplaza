<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCluMailbox extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clu_mailbox', function(Blueprint $table){
            $table->increments('id');
            $table->string('subject');
            $table->string('body');//beria ser puro html
            $table->string('message');//beria ser puro html
            $table->dateTime('date');
            $table->string('object');//tiene que ber casi con la tabla de datos
            $table->string('object_id');//el ide del objeto            
            $table->integer('user_sender_id')->unsigned();
            $table->integer('user_receiver_id')->unsigned();
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
        Schema::drop('clu_mailbox');
    }
}
