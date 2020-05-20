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
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('platform_id')->unsigned()->nullable();
            $table->integer('addon_id')->unsigned()->nullable();                      
            $table->integer('music_id')->unsigned()->nullable();    
            $table->integer('status_id')->unsigned()->default(1);             
            $table->integer('template_id')->unsigned()->nullable();
            $table->integer('payment_status')->unsigned()->nullable();  
            $table->string('coupon_code')->nullable();
            $table->integer('product_quantity')->default(1); 
            $table->decimal('total_price', 8, 2);	//with extra addons
            $table->string('logo')->nullable();      
            $table->integer('video_length')->default(10);  //hint fro user
            $table->longText('notes')->nullable();
            $table->string('background')->nullable();
            $table->string('background_color')->nullable();
            $table->string('delivery_id')->nullable();
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
