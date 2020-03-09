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
            $table->integer('location_id')->unsigned()->nullable();           
            $table->integer('coupon_id')->unsigned()->nullable();   
            $table->integer('music_id')->unsigned()->nullable();    
            $table->integer('status_id')->unsigned()->nullable();             
            $table->integer('template_id')->unsigned()->nullable();             


            $table->decimal('product_price', 8, 2);	 //product only
            $table->decimal('total_price', 8, 2);	//with extra addons

            $table->string('image')->nullable();      
            $table->integer('products_quantity')->default(1);
            $table->integer('video_length')->default(10);
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
        Schema::dropIfExists('orders');
    }
}
