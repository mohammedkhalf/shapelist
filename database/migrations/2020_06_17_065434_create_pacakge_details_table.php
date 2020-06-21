<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacakgeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacakge_details', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('package_id')->unsigned()->nullable();
            // $table->foreign('package_id')->references('id')->on('packages')->onDelete('CASCADE');
            // $table->integer('product_id')->unsigned()->nullable();
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            // $table->integer('quantity');
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
        Schema::dropIfExists('pacakge_details');
    }
}
