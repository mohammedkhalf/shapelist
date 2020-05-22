<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country', 225);
            $table->string('city', 225);
            $table->string('address', 225)->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('unit_no', 225)->nullable();
            $table->decimal('lng', 8, 2)->nullable();	
            $table->decimal('lat', 8, 2)->nullable();	
            $table->string('state', 225)->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');    
               
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
        Schema::dropIfExists('locations');
    }
}
