<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product\Product;

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
            'description' => 'wonderfull vedio',
            'image' => 'vedio.png',
            'price' => '1000'
        ]);

        Product::create([
            'name' => 'photograph',
            'description' => 'wonderfull photograph',
            'image' => 'photograph.png',
            'price' => '500'
        ]);
    }
}
