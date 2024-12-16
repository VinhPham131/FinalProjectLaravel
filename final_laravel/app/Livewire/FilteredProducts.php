<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\ProductCategory;

class FilteredProducts extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = '';
    public $selectedCategories = [];
    public $onSale = false;
    public $inStock = false;

    protected $listeners = ['filterUpdated' => 'onFilterUpdated'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function onFilterUpdated($filters)
    {
        $this->search = $filters['search'] ?? '';
        $this->sortBy = $filters['sortBy'] ?? '';
        $this->selectedCategories = array_filter(array: $filters['selectedCategories'] ?? []); // Filter empty values
        $this->onSale = $filters['onSale'] ?? false;
        $this->inStock = $filters['inStock'] ?? false;
        


        $this->resetPage();
    }

    public function render()
    {
        // Filter out any invalid or empty category IDs
        logger()->info('Applied Filters:', [
            'search' => $this->search,
            'sortBy' => $this->sortBy,
            'selectedCategories' => $this->selectedCategories,
            'onSale' => $this->onSale,
            'inStock' => $this->inStock,
        ]);

        $products = Product::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when(!empty($this->selectedCategories), fn($q) => $q->whereIn('category_id', $this->selectedCategories))
            ->when($this->onSale, fn($q) => $q->whereHas('category.sales', fn($sale) => $sale->where('percentage', '>', 0)))
            ->when($this->inStock, fn($q) => $q->where('quantity', '>', 0))
            ->when($this->sortBy === 'lowest_to_highest', fn($q) => $q->orderBy('price'))
            ->when($this->sortBy === 'highest_to_lowest', fn($q) => $q->orderByDesc('price'))
            ->when($this->sortBy === 'best_seller', fn($q) => $q->orderByDesc('sale_count'))
            ->paginate(9)
            ->through(function ($product) {
                $product->highest_sale = $product->highestSale();
                $product->discounted_price = $product->salePrice();
                return $product;
            });

        return view('livewire.filtered-products', compact('products'));
    }
}