<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Collection;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
                'collection_id' => Collection::where('name', 'Summer 2024')->first()->id,
                'productcode' => 'GVPAXMW000044',
                'color' => 'White',
                'category_id' => ProductCategory::where('name', 'Ring')->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '18K Gold Bracelet with Citrine PNJ Spring CTXMY000059',
                'description' => "With its bright yellow color, Citrine is a gemstone that holds optimistic and warm energy...",
                'price' => 40.00,
                'quantity' => 20,
                'material' => 'Citrine',
                'size' => '52',
                'stylecode' => 'TS456',
                'collection_id' => Collection::where('name', 'Spring 2024')->first()->id,
                'productcode' => 'GVCTXMY000059',
                'color' => 'Blue',
                'category_id' => ProductCategory::where('name', 'Bracelet')->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '18K Gold Bracelet with Ruby PNJ Spring RBXMY000180',
                'description' => "Refreshing the classic standard of 18K gold with a delicate Ruby stone, the PNJ bracelet embodies a fresh look, perfectly fitting to brighten the optimistic beauty of ladies. The perfect combination creates a luxurious gold bracelet, highlighting the wrist with a delicately set Ruby. This brilliance enhances the beauty of ladies, making them look charming and radiant when worn.",
                'price' => 50.00,
                'quantity' => 0,
                'material' => 'Ruby',
                'size' => '53',
                'stylecode' => 'BK789',
                'collection_id' => Collection::where('name', 'Winter 2023')->first()->id,
                'productcode' => 'GVRBXMY000180',
                'color' => 'Gold',
                'category_id' => ProductCategory::where('name', 'Necklace')->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
