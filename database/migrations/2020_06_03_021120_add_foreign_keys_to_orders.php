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
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('CASCADE');
            $table->foreign('delivery_id')->references('id')->on('deliveries')->onDelete('CASCADE');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('CASCADE');

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
            $table->dropForeign('orders_status_id_foreign');
            $table->dropForeign('orders_delivery_id_foreign');
            $table->dropForeign('orders_location_id_foreign');

        });
    }
}
