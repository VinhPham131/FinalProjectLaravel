<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
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
        $currentDate = now();

        // Create a unique cache key based on filters and pagination
        $cacheKey = $this->generateCacheKey();

        $products = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($currentDate) {
            $productsQuery = Product::with([
                'category',
                'collection',
                'sales' => function ($query) use ($currentDate) {
                    $query->where('percentage', '>', 0)
                        ->where('start_date', '<=', $currentDate)
                        ->where('end_date', '>=', $currentDate);
                },
            ])
                ->when($this->search, fn($query) => $query->where('products.name', 'LIKE', '%' . $this->search . '%'))
                ->when(!empty($this->selectedCategories), fn($query) => $query->whereIn('category_id', $this->selectedCategories))
                ->when($this->onSale, function ($query) use ($currentDate) {
                    $query->whereHas('sales', fn($saleQuery) => $saleQuery->where('percentage', '>', 0)
                            ->where('start_date', '<=', $currentDate)
                            ->where('end_date', '>=', $currentDate));
                })
                ->when($this->inStock, fn($query) => $query->where('quantity', '>', 0))
                ->select(
                    'products.*',
                    DB::raw('products.price * (1 - COALESCE(MAX(product_sales.percentage), 0) / 100) as discounted_price')
                )
                ->leftJoin('sales as product_sales', function ($join) {
                    $join->on('product_sales.sale_target_id', '=', 'products.id')
                        ->where('product_sales.sale_target_type', '=', 'product');
                })
                ->groupBy('products.id')
                ->when($this->sortBy, function ($query) {
                    match ($this->sortBy) {
                        'lowest_to_highest' => $query->orderBy('discounted_price', 'asc'),
                        'highest_to_lowest' => $query->orderBy('discounted_price', 'desc'),
                        'best_seller' => $query->orderByDesc('sale_count'),
                        default => $query,
                    };
                });

            // Paginate results
            $paginatedProducts = $productsQuery->paginate(9);

            // Transform product images
            $paginatedProducts->getCollection()->transform(function ($product) {
                $product->primary_image = $product->getPrimaryImagePath();
                return $product;
            });

            return $paginatedProducts;
        });

        return view('livewire.filtered-products', [
            'products' => $products,
        ]);
    }

    /**
     * Generate a cache key based on filters and pagination.
     *
     * @return string
     */
    private function generateCacheKey()
    {
        $filters = [
            'search' => $this->search,
            'sortBy' => $this->sortBy,
            'categories' => implode(',', $this->selectedCategories),
            'onSale' => $this->onSale,
            'inStock' => $this->inStock,
            'page' => $this->page ?? $this->pageName(),
        ];

        return 'filtered_products_' . md5(json_encode($filters));
    }
}
