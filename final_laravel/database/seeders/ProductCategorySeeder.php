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
            'Bangle',
            'Cufflinks',
            'Brooch',
            'Anklet',
            'Tiara',
            'Wedding Band',
            'Engagement Ring',
            'Gemstone Jewelry',
            'Pearl Jewelry',
        ];

        foreach ($categories as $name) {
            ProductCategory::create(['name' => $name]);
        }
    }
}