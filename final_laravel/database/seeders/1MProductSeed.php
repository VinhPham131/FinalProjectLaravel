<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class OneMProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $batchSize = 1000; // Number of records per batch
        $totalRecords = 1000000; // Total records to insert
        $records = [];
        $usedProductCodes = []; // To ensure unique product codes

        for ($i = 1; $i <= $totalRecords; $i++) {
            // Generate a unique product code
            do {
                $productCode = $faker->regexify('[A-Z0-9]{15}');
            } while (in_array($productCode, $usedProductCodes));

            // Add the product code to the used list
            $usedProductCodes[] = $productCode;

            $records[] = [
                'name' => $faker->word,
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 1, 1000),
                'quantity' => $faker->numberBetween(1, 100),
                'material' => $faker->word,
                'size' => $faker->randomElement(['S', 'M', 'L', 'XL']),
                'stylecode' => $faker->regexify('[A-Z0-9]{10}'),
                'collection_id' => $faker->optional()->numberBetween(1, 50),
                'productcode' => $productCode,
                'color' => $faker->safeColorName,
                'category_id' => $faker->numberBetween(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert batch and reset the array
            if ($i % $batchSize === 0) {
                DB::table('products')->insert($records);
                $records = [];
                $this->command->info("Inserted $i records...");
            }
        }

        // Insert remaining records
        if (!empty($records)) {
            DB::table('products')->insert($records);
        }

        $this->command->info("Seeded $totalRecords records successfully.");
    }
}