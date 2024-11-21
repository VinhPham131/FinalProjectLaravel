<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => '14K White Gold Bracelet with Akoya Pearl PNJ PAXMW000044',
                'description' => 'This bracelet attracts with its soft curves, making the wrist more elegant. Additionally, the 14K gold shine makes the product more fashionable and luxurious. With creativity from the design team, PNJ brings a beautiful Akoya pearl bracelet.',
                'price' => 30.00,
                'quantity' => 10,
                'material' => 'Akoya Pearl',
                'size' => '51',
                'stylecode' => 'SP123',
                'sales' => '15.00',
                'collection' => 'Summer 2024',
                'productcode' => 'GVPAXMW000044',
                'color' => 'White',
                'category' => 'Bracelet',
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
                'sales' => '10.00',
                'collection' => 'Spring 2024',
                'productcode' => 'GVCTXMY000059',
                'color' => 'Blue',
                'category' => 'Bracelet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
