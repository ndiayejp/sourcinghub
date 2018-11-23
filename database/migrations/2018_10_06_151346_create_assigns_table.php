<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('buyer_id')->unsigned();
            $table->integer('provider_id')->unsigned(); 
            
            $table->timestamps();
        });


        Schema::table('assigns',function($table){
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            
            $table->foreign('buyer_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('provider_id')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assigns');
    }
}
