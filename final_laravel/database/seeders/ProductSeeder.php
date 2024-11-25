<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => '14K White Gold Bracelet with Akoya Pearl PNJ PAXMW000044',
                'description' => 'This bracelet attracts...',
                'price' => 30.00,
                'quantity' => 10,
                'material' => 'Akoya Pearl',
                'size' => '51',
                'stylecode' => 'SP123',
                'collection' => 'Summer 2024',
                'productcode' => 'GVPAXMW000044',
                'color' => 'White',
                'category_id' => ProductCategory::where('name', 'Bracelet')->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '18K Gold Bracelet with Citrine PNJ Spring CTXMY000059',
                'description' => "With its bright yellow color, Citrine is a gemstone that holds optimistic and warm energy. By harmoniously combining Citrine and the shimmer of 18K gold, PNJ brings a bracelet product that praises the optimistic spirit and freedom in women's souls, as bright as the morning sun.",
                'price' => 40.00,
                'quantity' => 20,
                'material' => 'Citrine',
                'size' => '52',
                'stylecode' => 'TS456',
                'collection' => 'Spring 2024',
                'productcode' => 'GVCTXMY000059',
                'color' => 'Blue',
                'category_id' => ProductCategory::where('name', 'Bracelet')->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

