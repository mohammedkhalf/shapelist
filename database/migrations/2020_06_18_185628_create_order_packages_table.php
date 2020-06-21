<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned()->nullable();
            $table->integer('package_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('CASCADE');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('CASCADE');
            $table->integer('quantity')->default(1);
            $table->string('type')->default('package');
            $table->integer('package_music_id')->unsigned()->nullable();
            $table->foreign('package_music_id')->references('id')->on('music_samples')->onDelete('CASCADE');
            $table->string('vedio_length')->default(10);
            $table->string('package_user_music')->nullable();
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
        Schema::dropIfExists('order_packages');
    }
}
