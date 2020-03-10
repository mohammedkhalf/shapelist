<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Template\Template;
use Carbon\Carbon;

class TemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Template::create([
            'name' => 'tem1',
            'image' => 'temp1.png',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

        Template::create([
            'name' => 'tem2',
            'image' => 'temp2.png',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

    }
}
