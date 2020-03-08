<?php

use Illuminate\Database\Seeder;
use App\Models\Coupon\Coupon;
use Carbon\Carbon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => '23abc',
            'amount' => '2',
            'valid' => '1',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

        Coupon::create([
            'code' => '25efd',
            'amount' => '8',
            'valid' => '0',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
    }
}
