<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class Products extends Component
{
    public $products = [];  // List of products to display
    public $limit = 8;      // Number of products to display initially
    public $totalProducts;  // Total number of products

    public function mount()
    {
        $this->totalProducts = Product::count(); // Get the total number of products in the database
        $this->loadProducts();
    }

    public function loadProducts()
    {
        // Eager load the sales relationship and calculate the highest sale percentage for each product
        $this->products = Product::limit($this->limit)->get();
        // ->each(function ($product) {
            // Calculate the highest sale for each product and add it as an attribute
            // $product->getHighestSalePercentageAttribute();
        // });
    }

    public function showMore()
    {
        $this->limit += 8; // Increase the limit of displayed products
        $this->loadProducts();
    }

    public function showLess()
    {
        $this->limit = max(8, $this->limit - 8); // Decrease the limit, but not below 8
        $this->loadProducts();
    }

    public function render()
    {
        return view('livewire.products', [
            'products' => $this->products,
            'totalProducts' => $this->totalProducts,
        ]);
    }
}
