<?php

use Illuminate\Database\Seeder;
use App\Models\Platform\Platform;
use Carbon\Carbon;

class PlatformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Platform::create([
            'name'=> 'instgram',
            'image' => 'instgram.png',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
         ]);

         Platform::create([
            'name'=> 'snipchat',
            'image' => 'snipchat.png',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
         ]);
 
 
    }
}
