<?php

use Illuminate\Database\Seeder;
use App\Models\Addon\Addon;
use Carbon\Carbon;

class AddonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Addon::create([
            'name_en'=> 'Regular Delivery',
            'name_ar'=> 'استلام منتظم',
            'price' => '30',
            'description_en'=> 'Get your media within 72 hours',
            'description_ar'=> 'الاستلام خلال 72 ساعة',
            'package_type' => 'all',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

        Addon::create([
            'name_en'=> 'Fast Delivery',
            'name_ar'=> 'استلام سريع',
            'price' => '20',
            'package_type' => 'all',
            'description_en'=> 'Get your media within 48 hours',
            'description_ar'=> 'الاستلام خلال 48 ساعة',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
    }
}
