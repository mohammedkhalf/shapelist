<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->truncate();
        $pakage = [
            'id'                       => 1,
            'name_ar'                  => 'عرض الكومبو',
            'name_en'                  => 'compoo',
            'price'                    => 800,
            "desc_ar"                  => "تفاصيل الباكدج",
            "desc_en"                  => "package Desc",
            'created_at'            => Carbon::now(),
        ];

        DB::table('packages')->insert($pakage);

    }
}
