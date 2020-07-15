<?php

use Illuminate\Database\Seeder;
use App\Models\Order\Order;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Order::create([
            'user_id'=> '3',
            'status_id' => '1',
            'delivery_id' => '2',
            'location_id' => '2',
            'sub_total' => '1000',
            'vat' => '200',
            'total_price' => "1200",
            'created_at'  => Carbon::now("Asia/Riyadh"),
            'updated_at'  => Carbon::now("Asia/Riyadh")
        ]);

        Order::create([
            'user_id'=> '3',
            'status_id' => '2',
            'delivery_id' => '2',
            'location_id' => '2',
            'sub_total' => '1000',
            'vat' => '200',
            'total_price' => "1200",
            'created_at'  => Carbon::now("Asia/Riyadh"),
            'updated_at'  => Carbon::now("Asia/Riyadh")
        ]);

        Order::create([
            'user_id'=> '3',
            'status_id' => '3',
            'delivery_id' => '2',
            'location_id' => '2',
            'sub_total' => '1000',
            'vat' => '200',
            'total_price' => "1200",
            'created_at'  => Carbon::now("Asia/Riyadh"),
            'updated_at'  => Carbon::now("Asia/Riyadh")
        ]);

        
        Order::create([
            'user_id'=> '3',
            'status_id' => '4',
            'delivery_id' => '2',
            'location_id' => '2',
            'sub_total' => '1000',
            'vat' => '200',
            'total_price' => "1200",
            'created_at'  => Carbon::now("Asia/Riyadh"),
            'updated_at'  => Carbon::now("Asia/Riyadh")
        ]);

        Order::create([
            'user_id'=> '3',
            'status_id' => '5',
            'delivery_id' => '2',
            'location_id' => '2',
            'sub_total' => '1000',
            'vat' => '200',
            'total_price' => "1200",
            'created_at'  => Carbon::now("Asia/Riyadh"),
            'updated_at'  => Carbon::now("Asia/Riyadh")
        ]);

        Order::create([
            'user_id'=> '3',
            'status_id' => '1',
            'delivery_id' => '2',
            'location_id' => '2',
            'sub_total' => '1000',
            'vat' => '200',
            'total_price' => "1200",
            'created_at'  => Carbon::now("Asia/Riyadh"),
            'updated_at'  => Carbon::now("Asia/Riyadh")
        ]);

        Order::create([
            'user_id'=> '3',
            'status_id' => '2',
            'delivery_id' => '2',
            'location_id' => '2',
            'sub_total' => '1000',
            'vat' => '200',
            'total_price' => "1200",
            'created_at'  => Carbon::now("Asia/Riyadh"),
            'updated_at'  => Carbon::now("Asia/Riyadh")
        ]);

        Order::create([
            'user_id'=> '3',
            'status_id' => '3',
            'delivery_id' => '2',
            'location_id' => '2',
            'sub_total' => '1000',
            'vat' => '200',
            'total_price' => "1200",
            'created_at'  => Carbon::now("Asia/Riyadh"),
            'updated_at'  => Carbon::now("Asia/Riyadh")
        ]);

        
        Order::create([
            'user_id'=> '3',
            'status_id' => '4',
            'delivery_id' => '2',
            'location_id' => '2',
            'sub_total' => '1000',
            'vat' => '200',
            'total_price' => "1200",
            'created_at'  => Carbon::now("Asia/Riyadh"),
            'updated_at'  => Carbon::now("Asia/Riyadh")
        ]);

        Order::create([
            'user_id'=> '3',
            'status_id' => '5',
            'delivery_id' => '2',
            'location_id' => '2',
            'sub_total' => '1000',
            'vat' => '200',
            'total_price' => "1200",
            'created_at'  => Carbon::now("Asia/Riyadh"),
            'updated_at'  => Carbon::now("Asia/Riyadh")
        ]);
    }
}
