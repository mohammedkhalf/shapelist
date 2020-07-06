<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product\Product;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'vedio',
            'name_ar' => 'فيديو',
            'description' => 'wonderfull vedio',
            'description_ar' => 'wonderfull vedio',
            'image' => 'vedio.png',
            'price' => '1000',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

        Product::create([
            'name' => 'photograph',
            'name_ar' => 'صورة',
            'description' => 'wonderfull photograph',
            'description_ar' => 'wonderfull photograph',
            'image' => 'photograph.png',
            'price' => '500',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

        Product::create([
            'name' => '360',
            'name_ar' => '360',
            'description' => 'wonderfull 360',
            'description_ar' => 'wonderfull 360',
            'image' => 'photograph.png',
            'price' => '800',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
    }
}
