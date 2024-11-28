<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collections = [
            [
                'name' => 'Summer 2024',
                'description' => 'Bright designs perfect for Summer 2024.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Spring 2024',
                'description' => 'Refreshing and vibrant styles for Spring 2024.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Winter Elegance 2024',
                'description' => 'Chic and sophisticated designs for the winter season.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Winter 2023',
                'description' => 'Warm and cozy styles for Winter 2023.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($collections as $collection) {
            Collection::firstOrCreate(
                ['name' => $collection['name']],
                $collection
            );
        }
    }
}
