<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProductCategoryController;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $productCategoryController;

    // Inject ProductCategoryController into the constructor
    public function __construct(ProductCategoryController $productCategoryController)
    {
        $this->productCategoryController = $productCategoryController;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort'); // Retrieve the sort parameter

        $products = Product::with(['images', 'category', 'collection'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->when($sort, function ($query, $sort) {
                switch ($sort) {
                    case 'lowest_to_highest':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'highest_to_lowest':
                        $query->orderBy('price', 'desc');
                        break;
                }
            })
            ->get()
            ->map(function ($product) {
                $product->highest_sale = $product->highestSale();
                $product->discounted_price = $product->salePrice();
                return $product;
            });

        $categories = $this->productCategoryController->index();

        if ($request->ajax()) {
            return view('partials.products', compact('products'))->render();
        }

        return view('shop', compact('products', 'categories'));
    }
}