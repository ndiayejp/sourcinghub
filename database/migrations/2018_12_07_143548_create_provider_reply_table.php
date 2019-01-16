<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_reply', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->integer('tender_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->decimal('price',8,2)->default(0);
            $table->integer('product_id')->unsigned();

            $table->foreign('tender_id')->references('id')->on('tenders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('product_tenders')->onDelete('cascade');

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
        Schema::dropIfExists('provider_reply');
    }
}
