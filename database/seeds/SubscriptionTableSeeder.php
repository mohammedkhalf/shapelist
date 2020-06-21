<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Subscription\Subscription;
use Carbon\Carbon;

class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            Subscription::create([
                'name' => 'Silver',
                'purchase_points' => '200',
                'free_points' => '20',
                'discount' => '15',
                'details' => "you can't get the discount unless you spend all your points	",
                'duration' => '3',
                'price' => '1000',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()
            ]);
    
            Subscription::create([
                'name' => 'Golden',
                'purchase_points' => '500',
                'free_points' => '50',
                'discount' => '25',
                'details' => "you can't get the discount unless you spend all your points	",
                'duration' => '6',
                'price' => '2000',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()
            ]);

            Subscription::create([
                'name' => 'platinum',
                'purchase_points' => '1000',
                'free_points' => '100',
                'discount' => '40',
                'details' => "you can't get the discount unless you spend all your points	",
                'duration' => '9',
                'price' => '5000',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()
            ]);
        }
    }
}
