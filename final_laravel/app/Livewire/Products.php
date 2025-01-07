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
        $this->totalProducts = Cache::rememberForever('total_products', function () {
            return Product::count();
        });
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $cacheKey = "products_limit_{$this->limit}";
        $this->products = Cache::remember($cacheKey, now()->addMinutes(30), function () {
            return Product::limit($this->limit)->get();
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
        $lastUpdated = Cache::get('products_last_updated', 0);
        $latestUpdate = Product::max('updated_at')?->timestamp ?? 0;

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
