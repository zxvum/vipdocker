<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BillingStatus;
use App\Models\Country;
use App\Models\OrderProductStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            ShopSeeder::class,
            OrderStatusSeeder::class,
            ProductStatusSeeder::class,
            UserDocumentStatusSeeder::class,
            DocumentSeeder::class,
            PackageStatusSeeder::class,
            SupportSeeder::class,
            RoleTableSeeder::class,
            InvoiceStatusSeeder::class,
            ColorSeeder::class,

            UserSeeder::class,
        ]);
    }
}
