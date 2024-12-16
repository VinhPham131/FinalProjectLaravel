<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Bracelet',
            'Ring',
            'Earrings',
            'Necklace',
            'Pendant',
            'Charm',
            'Anklet',
            'Watch'
        ];

        foreach ($categories as $name) {
            ProductCategory::create(['name' => $name]);
        }
    }
}