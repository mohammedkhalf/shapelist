<?php

use Illuminate\Database\Seeder;
use App\Models\Location\Location;
use Carbon\Carbon;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'country'=> 'Saudi Arabia',
            'city' => 'Riyadh',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
            ]);

        Location::create([
            'country'=> 'Saudi Arabia',
            'city' => 'Mecca',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
            ]);

            Location::create([
                'country'=> 'Saudi Arabia',
                'city' => 'Dammam',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()
                ]);

                
            Location::create([
                'country'=> 'Saudi Arabia',
                'city' => 'Madina',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()
                ]);

    }
}
