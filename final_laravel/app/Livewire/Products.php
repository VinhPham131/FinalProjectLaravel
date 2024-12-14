<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class Products extends Component
{
    public $products = [];
    public $search = '';
    public $sortBy = '';
    public $categories = [];

    protected $listeners = ['filterUpdated' => 'onFilterUpdated'];

    public function mount()
    {
        $this->applyFilters();
    }

    public function onFilterUpdated($filters)
    {
        logger("Filters received: ", $filters);
        $this->search = $filters['search'] ?? '';
        $this->sortBy = $filters['sortBy'] ?? '';
        $this->categories = $filters['selectedCategories'] ?? [];

        $this->applyFilters();
    }

    public function applyFilters()
    {
        $query = Product::query();

        // Apply search filter
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Apply sorting
        if ($this->sortBy === 'lowest_to_highest') {
            $query->orderByRaw('price * (1 - COALESCE((SELECT MAX(percentage) FROM sales WHERE sales.name = products.category_id OR sales.name = products.collection_id), 0) / 100) ASC');
        } elseif ($this->sortBy === 'highest_to_lowest') {
            $query->orderByRaw('price * (1 - COALESCE((SELECT MAX(percentage) FROM sales WHERE sales.name = products.category_id OR sales.name = products.collection_id), 0) / 100) DESC');
        }

        $this->products = $query->get()->map(function ($product) {
            $product->highest_sale = $product->highestSale();
            $product->discounted_price = $product->salePrice();
            return $product;
        });
    }

    public function render()
    {
        return view('livewire.products', [
            'products' => $this->products
        ]);
    }
}