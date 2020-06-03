<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Delivery\Delivery;
use Carbon\Carbon;

class DeliveryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            
        Delivery::create([
            'name' => 'Express',
            'price' => '300',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
        Delivery::create([
            'name' => 'Fast',
            'price' => '200',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
        Delivery::create([
            'name' => 'Standard',
            'price' => '120',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
    }
}
