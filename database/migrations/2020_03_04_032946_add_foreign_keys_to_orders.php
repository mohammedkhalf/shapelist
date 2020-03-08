<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('CASCADE');
            $table->foreign('addon_id')->references('id')->on('addons')->onDelete('CASCADE');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('CASCADE');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('CASCADE');
            $table->foreign('music_id')->references('id')->on('music_samples')->onDelete('CASCADE');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_user_id_foreign');
            $table->dropForeign('orders_product_id_foreign');
            $table->dropForeign('orders_platform_id_foreign');
            $table->dropForeign('orders_addon_id_foreign');
            $table->dropForeign('orders_location_id_foreign');
            $table->dropForeign('orders_coupon_id_foreign');
            $table->dropForeign('orders_music_id_foreign');

        });
    }
}
