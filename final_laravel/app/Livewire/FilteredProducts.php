<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

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
        // Get the current date for checking active sales
        $currentDate = now();

        // Build the query for filtering products
        $products = Product::with([
            'images',
            'category',
            'collection',
            'sales' => function ($query) use ($currentDate) {
                $query->where('percentage', '>', 0)
                    ->where('start_date', '<=', $currentDate)
                    ->where('end_date', '>=', $currentDate);
            },
            'category.sales',
            'collection.sales'
        ])
            // Search filter: Filter by product name
            ->when($this->search, fn($query) => $query->where('products.name', 'LIKE', '%' . $this->search . '%'))

            // Category filter: Filter by selected categories
            ->when(!empty($this->selectedCategories), fn($query) => $query->whereIn('category_id', $this->selectedCategories))

            // On sale filter: Products that have an active sale
            ->when($this->onSale, function ($query) use ($currentDate) {
                $query->whereHas('sales', function ($saleQuery) use ($currentDate) {
                    $saleQuery->where('percentage', '>', 0)
                        ->where('start_date', '<=', $currentDate)
                        ->where('end_date', '>=', $currentDate);
                })
                    ->orWhereHas('category.sales', function ($saleQuery) use ($currentDate) {
                        $saleQuery->where('percentage', '>', 0)
                            ->where('start_date', '<=', $currentDate)
                            ->where('end_date', '>=', $currentDate);
                    })
                    ->orWhereHas('collection.sales', function ($saleQuery) use ($currentDate) {
                        $saleQuery->where('percentage', '>', 0)
                            ->where('start_date', '<=', $currentDate)
                            ->where('end_date', '>=', $currentDate);
                    });
            })

            // In stock filter: Products that have a quantity greater than 0
            ->when($this->inStock, fn($query) => $query->where('quantity', '>', 0))

            // Sorting: Apply sorting based on selected option
            ->when($this->sortBy, function ($query) {
                match ($this->sortBy) {
                    'lowest_to_highest' => $query->orderBy('price', 'asc'),
                    'highest_to_lowest' => $query->orderBy('price', 'desc'),
                    'best_seller' => $query->orderByDesc('sale_count'),
                    default => $query, // Do nothing if no sorting is selected
                };
            })
            // Paginate results, 9 products per page
            ->paginate(9);

        // Return the view with the filtered products
        return view('livewire.filtered-products', [
            'products' => $products,
        ]);
    }
}

