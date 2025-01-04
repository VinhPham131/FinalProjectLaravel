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
        // Get the current date for checking active sales
        $currentDate = now();

        // Build the query for filtering products
        $productsQuery = Product::with([
            'category',
            'collection',
            'sales' => function ($query) use ($currentDate) {
                $query->where('percentage', '>', 0)
                    ->where('start_date', '<=', $currentDate)
                    ->where('end_date', '>=', $currentDate);
            },
            'category.sales',
            'collection.sales',
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

            // Select the necessary columns and calculate the discounted price
            ->select(
                'products.*',
                DB::raw('products.price - (products.price * COALESCE(MAX(category_sales.percentage), MAX(collection_sales.percentage), MAX(product_sales.percentage), 0) / 100) as discounted_price')
            )
            ->leftJoin('product_categories', 'product_categories.id', '=', 'products.category_id')
            ->leftJoin('sales as category_sales', function ($join) {
                $join->on('category_sales.sale_target_id', '=', 'product_categories.id')
                    ->where('category_sales.sale_target_type', '=', 'category');
            })
            ->leftJoin('collections', 'collections.id', '=', 'products.collection_id')
            ->leftJoin('sales as collection_sales', function ($join) {
                $join->on('collection_sales.sale_target_id', '=', 'collections.id')
                    ->where('collection_sales.sale_target_type', '=', 'collection');
            })
            ->leftJoin('sales as product_sales', function ($join) {
                $join->on('product_sales.sale_target_id', '=', 'products.id')
                    ->where('product_sales.sale_target_type', '=', 'product');
            })
            ->groupBy('products.id')

            // Sorting: Apply sorting based on selected option
            ->when($this->sortBy, function ($query) {
                match ($this->sortBy) {
                    'lowest_to_highest' => $query->orderBy('discounted_price', 'asc'),
                    'highest_to_lowest' => $query->orderBy('discounted_price', 'desc'),
                    'best_seller' => $query->orderByDesc('sale_count'),
                    default => $query, // Do nothing if no sorting is selected
                };
            });

        // Paginate results, 9 products per page
        $products = $productsQuery->paginate(9);

        // Add primary image paths from the media library
        $products->getCollection()->transform(function ($product) {
            $product->primary_image = $product->getPrimaryImagePath();
            return $product;
        });

        // Return the view with the filtered products
        return view('livewire.filtered-products', [
            'products' => $products,
        ]);
    }
}
