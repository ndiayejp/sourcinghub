<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('company')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable(); 
            $table->tinyInteger('fax')->nullable(); 
            $table->string('website')->nullable(); 
            $table->string('bp')->nullable(); 
            $table->string('siret')->nullable(); 
            $table->string('tva')->nullable(); 
            $table->boolean('unit_abroard')->default(0);
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('profiles');
    }
}
