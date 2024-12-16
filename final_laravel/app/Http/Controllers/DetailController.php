<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    public function show($slug)
    {
        try {
            $product = Product::where('slug', $slug)->firstOrFail();

            // Calculate sale-related attributes for the main product
            $this->calculateSaleAttributes($product); // TODO: SHOULD IMPROVE THIS

            $related_products = Product::with('images')
                ->select([
                    'products.*',
                    DB::raw('MAX(sales.percentage) as highest_sale'),
                ])
                ->join('product_categories', 'product_categories.id', '=', 'products.category_id')
                ->join('sales', 'sales.name', '=', 'product_categories.name')
                ->groupBy('products.id')
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
        } catch (ModelNotFoundException $e) {
            // Return custom 'product-not-found' view
            return view('errors.product-not-found');
        }
    }

    private function calculateSaleAttributes($product)
    {
        $product->highest_sale = $product->highestSale();
        $product->discounted_price = $product->salePrice();
    }
}