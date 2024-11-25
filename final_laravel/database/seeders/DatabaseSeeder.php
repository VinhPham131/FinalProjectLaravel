<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProductCategorySeeder::class,
            ProductSeeder::class,
            ProductImagesSeeder::class,
            SaleSeeder::class,
        ]);
    }
}
