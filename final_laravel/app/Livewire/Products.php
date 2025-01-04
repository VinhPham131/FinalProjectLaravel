<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class Products extends Component
{
    public $products = [];
    public $limit = 8;
    public $totalProducts;

    public function mount()
    {
        $this->updateCache();
        $this->totalProducts = Cache::forever('total_products', function () {
            return Product::count();
        });
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $cacheKey = "products_{$this->limit}";
        $this->products = Cache::forever($cacheKey, function () {
            // return Product::limit($this->limit)->get();
            return Product::cursor();
        });
    }

    public function showMore()
    {
        $this->limit += 8;
        $this->loadProducts();
    }

    public function showLess()
    {
        $this->limit = max(8, $this->limit - 8);
        $this->loadProducts();
    }

    private function updateCache()
    {
        // Check if products have been updated
        $lastUpdated = Cache::get('products_last_updated', 0);
        $latestUpdate = Product::max('updated_at')->timestamp ?? 0;

        if ($latestUpdate > $lastUpdated) {
            Cache::flush();
            Cache::forever('products_last_updated', $latestUpdate);
        }
    }

    public function render()
    {
        return view('livewire.products', [
            'products' => $this->products,
            'totalProducts' => $this->totalProducts,
        ]);
    }
}