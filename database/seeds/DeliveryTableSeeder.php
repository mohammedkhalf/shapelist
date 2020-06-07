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
            'name_en' => 'Express',
            'name_ar' => 'فائق السرعة',
            'price' => '300',
            'description_en' => 'Express Delivery',
            'description_ar' => 'توصيل فائق السرعة',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
        Delivery::create([
            'name_en' => 'Fast',
            'name_ar' => 'سريع',
            'price' => '200',
            'description_en' => 'Fast Delivery',
            'description_ar' => ' توصيل سريع',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
        Delivery::create([
            'name_en' => 'Standard',
            'name_ar' => 'عادي',
            'description_en' => 'Standard Delivery',
            'description_ar' => ' توصيل عادي',
            'price' => '120',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
    }
}
