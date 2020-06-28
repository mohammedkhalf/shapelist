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
            $table->integer('status_id')->unsigned()->default(1);     
            $table->integer('delivery_id')->unsigned()->nullable(); 
            $table->integer('location_id')->unsigned()->nullable(); 

            $table->decimal('sub_total')->default(1);
            $table->decimal('vat')->default(1);
            $table->decimal('total_price')->default(1);

            $table->string('payment_status')->nullable();
            $table->dateTime('on_set')->nullable(); 
            $table->string('coupon_code')->nullable();
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
