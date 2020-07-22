<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamesToSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->string('purchase_points_ar')->nullable();
            $table->string('free_points_ar')->nullable();          
            $table->string('discount_ar')->nullable();
            $table->string('duration_ar')->nullable();
            $table->string('price_ar')->nullable();
            $table->text('details_ar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('purchase_points_ar');
            $table->dropColumn('free_points_ar');          
            $table->dropColumn('discount_ar');
            $table->dropColumn('duration_ar');
            $table->dropColumn('price_ar');
            $table->dropColumn('details_ar');
        });
    }
}
