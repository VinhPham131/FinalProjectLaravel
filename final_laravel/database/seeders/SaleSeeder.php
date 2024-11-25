<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;

class SaleSeeder extends Seeder
{
    public function run()
    {
        $sales = [
            [
                'name' => 'Bracelet',
                'type' => 'category',
                'percentage' => 10.00,
                'start_date' => '2024-12-01',
                'end_date' => '2024-12-31',
            ],
            [
                'name' => 'Summer 2024',
                'type' => 'collection',
                'percentage' => 15.00,
                'start_date' => '2024-06-01',
                'end_date' => '2024-08-31',
            ],
        ];

        foreach ($sales as $sale) {
            Sale::create($sale);
        }
    }
}
