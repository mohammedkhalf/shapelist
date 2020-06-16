<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(AccessTableSeeder::class);
        $this->call(HistoryTypeTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(PlatformsTableSeeder::class);
        $this->call(AddonsTableSeeder::class); 
        $this->call(CouponsTableSeeder::class);
        $this->call(TemplateTableSeeder::class); 
        $this->call(LocationsTableSeeder::class);  
        $this->call(MusicSamplesTableSeeder::class);  
        $this->call(QuotationTableSeeder::class);  
        $this->call(DeliveryTableSeeder::class);  
        $this->call(PaymentTableSeeder::class); 
        $this->call(PackageTableSeeder::class);  
        Model::reguard();
    }
}
