<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('status_id')->unsigned()->nullable();     
            $table->integer('delivery_id')->unsigned()->nullable(); 
            $table->decimal('total_price');
            $table->dateTime('on_set')->nullable(); 
            $table->string('coupon_code')->nullable();
            $table->integer('music_id')->unsigned()->nullable();        
            $table->integer('video_length')->default(10); 
            $table->string('user_music')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
