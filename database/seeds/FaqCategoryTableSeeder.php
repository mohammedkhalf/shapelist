<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\FaqCategory\FaqCategory;
use Carbon\Carbon;

class FaqCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FaqCategory::create([
            'name'=> "general",
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

        FaqCategory::create([
            'name'=> "package",
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
        FaqCategory::create([
            'name'=> "subscription",
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
    }
}
