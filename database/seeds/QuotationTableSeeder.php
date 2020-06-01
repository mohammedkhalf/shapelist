<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Quotation\Quotation;
use Carbon\Carbon;

class QuotationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Quotation::create([
            'name' => 'VAT',
            'rate' => '5',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

        Quotation::create([
            'name' => 'On Set',
            'rate' => '500',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
    }
}
