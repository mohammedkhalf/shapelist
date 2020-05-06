<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en', 225)->unique();
            $table->string('name_ar', 225)->unique();
            $table->string('package_type', 225)->nullable();
            $table->string('description_en', 225)->nullable();
            $table->string('description_ar', 225)->nullable();
            $table->decimal('price');	
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
        Schema::dropIfExists('addons');
    }
}
