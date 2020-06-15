<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('subscription_id')->unsigned()->nullable();
            $table->boolean('subscription_status')->nullable();
            $table->integer('purchase_points')->nullable();
            $table->integer('free_points')->nulllable();
            $table->dateTime('subscription_start_date')->nullable();
            $table->dateTime('subscription_end_date')->nullable();
            $table->string('subscription_bank_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('CASCADE');
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
        Schema::dropIfExists('subscription_details');
    }
}
