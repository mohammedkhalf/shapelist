<?php

use Illuminate\Database\Seeder;
use App\Models\Status\Status;
use Carbon\Carbon;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
           'type'=>'Pinding',
           'created_at'  => Carbon::now(),
           'updated_at'  => Carbon::now()
        ]);

        Status::create([
            'type'=>'Processing',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
         ]);

         Status::create([
            'type'=>'Done',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
         ]);

         Status::create([
            'type'=>'Deliver',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
         ]);
  
    }
}
