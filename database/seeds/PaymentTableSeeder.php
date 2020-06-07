<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Payment\Payment;
use Carbon\Carbon;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'status'=> 1,
            'bank_transaction_id'=> '343874389749380938493',
            'failure_reason'=> '',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

        Payment::create([
            'status'=> 1,
            'bank_transaction_id'=> '300949597493809385547',
            'failure_reason'=> '',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
        Payment::create([
            'status'=> 2,
            'bank_transaction_id'=> '758477898400555328940',
            'failure_reason'=> ' Bank Transaction error!',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
    }
}
