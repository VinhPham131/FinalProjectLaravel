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
                'description' => 'This bracelet attracts attention with its simple yet elegant design, featuring an Akoya Pearl.',
                'price' => 30.00,
                'quantity' => 10,
                'material' => 'Akoya Pearl',
                'size' => '51',
                'stylecode' => 'SP123',
                'collection_id' => Collection::where('name', 'Summer 2024')->first()->id,
                'productcode' => 'GVPAXMW000044',
                'color' => 'White',
                'category_id' => ProductCategory::where('name', 'Bracelet')->first()->id,
            ],
            [
                'name' => '18K Gold Bracelet with Citrine PNJ Spring CTXMY000059',
                'description' => "Citrine's bright yellow color symbolizes optimism and warmth, making it a perfect gift.",
                'price' => 40.00,
                'quantity' => 20,
                'material' => 'Citrine',
                'size' => '52',
                'stylecode' => 'TS456',
                'collection_id' => Collection::where('name', 'Spring 2024')->first()->id,
                'productcode' => 'GVCTXMY000059',
                'color' => 'Yellow',
                'category_id' => ProductCategory::where('name', 'Bracelet')->first()->id,
            ],
            [
                'name' => '18K Gold Necklace with Ruby PNJ Spring RBXMY000180',
                'description' => "This luxurious necklace with a Ruby centerpiece complements the wearer's elegance.",
                'price' => 50.00,
                'quantity' => 0,
                'material' => 'Ruby',
                'size' => '53',
                'stylecode' => 'BK789',
                'collection_id' => Collection::where('name', 'Winter 2023')->first()->id,
                'productcode' => 'GVRBXMY000180',
                'color' => 'Gold',
                'category_id' => ProductCategory::where('name', 'Necklace')->first()->id,
            ],
            [
                'name' => 'Sterling Silver Ring with Sapphire PNJ Autumn SAPXMR000200',
                'description' => 'A timeless ring design with a sparkling Sapphire stone.',
                'price' => 25.00,
                'quantity' => 15,
                'material' => 'Sapphire',
                'size' => '7',
                'stylecode' => 'RG112',
                'collection_id' => Collection::where('name', 'Winter Elegance 2024')->first()->id,
                'productcode' => 'GVAPMR000200',
                'color' => 'Blue',
                'category_id' => ProductCategory::where('name', 'Ring')->first()->id,
            ],
            [
                'name' => '18K Yellow Gold Earrings with Emerald PNJ EXMGW000345',
                'description' => 'Elegant earrings showcasing emerald stones in a modern design.',
                'price' => 60.00,
                'quantity' => 8,
                'material' => 'Emerald',
                'size' => 'One Size',
                'stylecode' => 'ER234',
                'collection_id' => Collection::where('name', 'Spring 2024')->first()->id,
                'productcode' => 'GVEXMGW000345',
                'color' => 'Green',
                'category_id' => ProductCategory::where('name', 'Earrings')->first()->id,
            ],
            [
                'name' => 'Rose Gold Anklet with Diamonds PNJ ANKRDW000501',
                'description' => 'A graceful anklet featuring sparkling diamonds and a rose gold finish.',
                'price' => 70.00,
                'quantity' => 5,
                'material' => 'Diamond',
                'size' => '9',
                'stylecode' => 'ANK123',
                'collection_id' => Collection::where('name', 'Winter 2023')->first()->id,
                'productcode' => 'GVANKRDW000501',
                'color' => 'Rose Gold',
                'category_id' => ProductCategory::where('name', 'Anklet')->first()->id,
            ],
            [
                'name' => 'Platinum Pendant with Topaz PNJ PDTXMY000712',
                'description' => 'A sleek pendant with a stunning Topaz centerpiece, perfect for daily wear.',
                'price' => 90.00,
                'quantity' => 3,
                'material' => 'Topaz',
                'size' => 'One Size',
                'stylecode' => 'PD345',
                'collection_id' => Collection::where('name', 'Summer 2024')->first()->id,
                'productcode' => 'GVPDTXMY000712',
                'color' => 'Silver',
                'category_id' => ProductCategory::where('name', 'Pendant')->first()->id,
            ],
            [
                'name' => 'Gold Chain Necklace PNJ CHGWM000820',
                'description' => 'A classic gold chain necklace, suitable for all occasions.',
                'price' => 100.00,
                'quantity' => 10,
                'material' => 'Gold',
                'size' => '24 inches',
                'stylecode' => 'CH567',
                'collection_id' => Collection::where('name', 'Spring 2024')->first()->id,
                'productcode' => 'GVCHGWM000820',
                'color' => 'Gold',
                'category_id' => ProductCategory::where('name', 'Necklace')->first()->id,
            ],
            [
                'name' => 'Amethyst Stud Earrings PNJ STEAM000400',
                'description' => 'Simple and elegant amethyst studs, perfect for casual and formal wear.',
                'price' => 45.00,
                'quantity' => 25,
                'material' => 'Amethyst',
                'size' => 'One Size',
                'stylecode' => 'ST890',
                'collection_id' => Collection::where('name', 'Winter Elegance 2024')->first()->id,
                'productcode' => 'GVSTEAM000400',
                'color' => 'Purple',
                'category_id' => ProductCategory::where('name', 'Earrings')->first()->id,
            ],
            [
                'name' => 'White Gold Ring with Diamonds PNJ WRGDW000954',
                'description' => 'A statement ring crafted with white gold and dazzling diamonds.',
                'price' => 150.00,
                'quantity' => 4,
                'material' => 'Diamond',
                'size' => '6',
                'stylecode' => 'WR001',
                'collection_id' => Collection::where('name', 'Winter 2023')->first()->id,
                'productcode' => 'GVWRGDW000954',
                'color' => 'White',
                'category_id' => ProductCategory::where('name', 'Ring')->first()->id,
            ],
            [
                'name' => 'Yellow Gold Cuff Bracelet PNJ BRYGW000600',
                'description' => 'A bold yellow gold cuff bracelet that adds elegance to any outfit.',
                'price' => 200.00,
                'quantity' => 7,
                'material' => 'Gold',
                'size' => 'Adjustable',
                'stylecode' => 'CF567',
                'collection_id' => Collection::where('name', 'Spring 2024')->first()->id,
                'productcode' => 'GVBRYGW000600',
                'color' => 'Gold',
                'category_id' => ProductCategory::where('name', 'Bracelet')->first()->id,
            ],
            [
                'name' => 'Titanium Watch with Sapphire Glass PNJ WTTSG000340',
                'description' => 'Durable titanium watch with scratch-resistant sapphire glass.',
                'price' => 250.00,
                'quantity' => 12,
                'material' => 'Titanium',
                'size' => 'One Size',
                'stylecode' => 'WT123',
                'collection_id' => Collection::where('name', 'Summer 2024')->first()->id,
                'productcode' => 'GVWTTSG000340',
                'color' => 'Gray',
                'category_id' => ProductCategory::where('name', 'Watch')->first()->id,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product + ['created_at' => now(), 'updated_at' => now()]);
        }
    }
}
