<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->dateTime('closing_date');
            $table->dateTime('delivery_date');
            $table->enum('payment_method', ['Immédiat', '30 jours','90 jours','Négocier']);
            $table->enum('offer_in_device',['Cfa','Euro','Dollar']);
            $table->string('address_delivery');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
}
