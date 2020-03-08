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
            'name'=> 'banner',
            'type' => 'photoshop Design',
            'price' => '50',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
         ]);

         Addon::create([
            'name'=> 'flyer',
            'type' => 'photoshop Design',
            'price' => '100',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
         ]);
    }
}
