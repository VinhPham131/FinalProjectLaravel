<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProductCategoryController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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

        $categories = Cache::remember('categories', 60, function () {
            return $this->productCategoryController->index();; // Retrieve directly from the database or cache
        });

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
            ->select('products.*', DB::raw('MAX(sales.percentage) as highest_sale'), DB::raw('MAX(sales.percentage) * products.price / 100 as discounted_price'))
            ->join('product_categories', 'product_categories.id', '=', 'products.category_id') // Join with categories
            ->leftJoin('sales', function ($join) {
                $join->on('sales.name', '=', 'product_categories.name') // Match sale's name to category name
                    ->where('sales.sale_target', '=', 'category'); // Only for categories (or collections, as needed)
            })
            ->groupBy('products.id')
            ->get();

        if ($request->ajax()) {
            return view('partials.products', compact('products'))->render();
        }

        return view('shop', compact('products', 'categories'));
    }
}