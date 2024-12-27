<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class FilteredProducts extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = '';
    public $selectedCategories = [];
    public $onSale = false;
    public $inStock = false;

    protected $listeners = ['filterUpdated' => 'onFilterUpdated'];

    /**
     * Reset pagination when search input changes.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Update filters dynamically via Livewire events.
     *
     * @param array $filters
     */
    public function onFilterUpdated($filters)
    {
        $this->search = $filters['search'] ?? '';
        $this->sortBy = $filters['sortBy'] ?? '';
        $this->selectedCategories = array_filter($filters['selectedCategories'] ?? []);
        $this->onSale = $filters['onSale'] ?? false;
        $this->inStock = $filters['inStock'] ?? false;

        $this->resetPage();
    }

    /**
     * Render the Livewire component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Build the query for filtering products
        $products = Product::with(['images', 'category', 'collection'])
            ->when($this->search, fn($query) => $query->where('products.name', 'LIKE', '%' . $this->search . '%'))
            ->when(!empty($this->selectedCategories), fn($query) => $query->whereIn('category_id', $this->selectedCategories))
            ->when($this->onSale, function ($query) {
                $query->whereHas('product.sales', function ($saleQuery) {
                    $saleQuery->where('percentage', '>', 0);
                })->orWhereHas('collection.sales', function ($saleQuery) {
                    $saleQuery->where('percentage', '>', 0);
                })->orWhereHas('category.sales', function ($saleQuery) {
                    $saleQuery->where('percentage', '>', 0);
                });
            })
            ->when($this->inStock, fn($query) => $query->where('quantity', '>', 0))
            ->when($this->sortBy, function ($query) {
                match ($this->sortBy) {
                    'lowest_to_highest' => $query->orderBy('price', 'asc'),
                    'highest_to_lowest' => $query->orderBy('price', 'desc'),
                    'best_seller' => $query->orderBy('sale_count', 'desc'),
                    default => null,
                };
            })
            ->select(
                'products.*',
                DB::raw('MAX(sales.percentage) as highest_sale'),
                DB::raw('products.price - (products.price * MAX(sales.percentage) / 100) as discounted_price')
            )
            ->leftJoin('product_categories', 'product_categories.id', '=', 'products.category_id')
            ->leftJoin('sales', function ($join) {
                $join->on('sales.name', '=', 'product_categories.name')
                    ->where('sales.sale_target', '=', 'category');
            })
            ->groupBy('products.id')
            ->paginate(9);

        return view('livewire.filtered-products', [
            'products' => $products,
        ]);
    }
}
