<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductCategory; // Ensure you have this model
use App\Models\Sale; // Ensure you have this model
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

// If you're using collections, ensure this model is available

class SaleSeeder extends Seeder
{
    public function run()
    {
        $sales = [
            // Sale for a category
            [
                'name' => 'Bracelet Sale',
                'sale_target_type' => 'category',
                'sale_target_id' => ProductCategory::where('name', 'Bracelet')->first()?->id, // Ensure category exists
                'percentage' => 10.00,
                'start_date' => '2024-12-01',
                'end_date' => '2024-12-31',
            ],
            // Sale for a category
            [
                'name' => 'Ring Sale',
                'sale_target_type' => 'category',
                'sale_target_id' => ProductCategory::where('name', 'Ring')->first()?->id, // Ensure category exists
                'percentage' => 15.00,
                'start_date' => '2024-06-01',
                'end_date' => '2025-08-31',
            ],
            // Sale for a product
            [
                'name' => 'Exclusive Gold Ring Sale',
                'sale_target_type' => 'product',
                'sale_target_id' => Product::where('name', '18K Yellow Gold Earrings with Emerald PNJ EXMGW000345')->first()?->id, // Ensure product exists
                'percentage' => 20.00,
                'start_date' => '2024-05-01',
                'end_date' => '2025-05-31',
            ],
            // Sale for a collection
            [
                'name' => 'Summer 2024 Collection Sale',
                'sale_target_type' => 'collection',
                'sale_target_id' => Collection::where('name', 'Summer 2024')->first()?->id, // Ensure collection exists
                'percentage' => 25.00,
                'start_date' => '2024-06-01',
                'end_date' => '2025-08-31',
            ],
        ];

        foreach ($sales as $sale) {
            // Check if sale_target_id is set before creating the sale
            if ($sale['sale_target_id']) {
                Sale::create($sale);
            } else {
                // Optionally log a message if the target was not found
                Log::warning("Sale target not found for sale: {$sale['name']}");
            }
        }
    }
}
