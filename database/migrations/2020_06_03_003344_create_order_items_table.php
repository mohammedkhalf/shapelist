<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('platform_id')->unsigned()->nullable();
            $table->integer('music_id')->unsigned()->nullable();  
            $table->integer('product_quantity')->default(1); 
            $table->decimal('product_total_price');
            $table->string('logo')->nullable();
            $table->integer('video_length')->default(10);  //hint fro user
            $table->longText('content')->nullable();
            $table->string('background')->nullable();
            $table->string('background_color')->nullable();
            $table->string('user_music')->nullable();
            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('order_items');
    }
}
