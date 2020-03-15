<?php

use Illuminate\Database\Seeder;
use App\Models\MusicSample\MusicSample;
use Carbon\Carbon;

class MusicSamplesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MusicSample::create([
            'name'=> 'music one',
            'url' => 'rab.mp3',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
            ]);

            MusicSample::create([
                'name'=> 'music two',
                'url' => 'rockStar.mp3',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()
                ]);
    }
}
