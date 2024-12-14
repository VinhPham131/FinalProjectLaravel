<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        // Calculate sale-related attributes for the main product
        $this->calculateSaleAttributes($product);

        $related_products = Product::with('images')
            ->select([
                'products.id',
                'products.slug',
                'products.name',
                'products.price',
                'products.category_id',
                DB::raw('MAX(sales.percentage) as highest_sale'),
            ])
            ->join('product_categories', 'product_categories.id', '=', 'products.category_id')
            ->join('sales', 'sales.name', '=', 'product_categories.name')
            ->groupBy('products.id', 'products.slug', 'products.name', 'products.price', 'products.category_id')
            ->get()
            ->each(function (Product $product) {
                if ($product->highest_sale) {
                    $product->discounted_price = $product->highest_sale
                        ? $product->price * (1 - $product->highest_sale / 100)
                        : $product->price;
                } else {
                    $product->discounted_price = null;
                }
            });

        return view('detail', compact('product', 'related_products'));
    }

    private function calculateSaleAttributes($product)
    {
        $product->highest_sale = $product->highestSale();
        $product->discounted_price = $product->salePrice();
    }
}