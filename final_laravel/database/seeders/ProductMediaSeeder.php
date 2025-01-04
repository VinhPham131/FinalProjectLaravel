<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the image folder path to 'storage/app/public'
        $imagePath = base_path('seed-images');

        // Loop through the products
        $products = Product::all();
        foreach ($products as $product) {
            // Specify the folder path based on product id
            $folderPath = $imagePath . '/' . $product->id;

            // Check if the folder exists
            if (is_dir($folderPath)) {
                // Scan the folder and get all files (excluding . and ..)
                $files = array_diff(scandir($folderPath), ['.', '..']);

                // Loop through each file and add it to the product's media collection
                foreach ($files as $file) {
                    $filePath = $folderPath . '/' . $file;

                    // Ensure the file is an image
                    if (is_file($filePath) && in_array(pathinfo($filePath, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])) {
                        // Add image to product's media
                        $product
                            ->addMedia($filePath)
                            ->preservingOriginal()
                            ->toMediaCollection('products'); // Adjust collection name if needed
                    }
                }
            }
        }
    }
}
