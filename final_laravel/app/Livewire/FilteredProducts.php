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

    public function render()
    {
        // Create a unique cache key
        $cacheKey = $this->generateCacheKey();

        // Cache products
        $products = Cache::remember($cacheKey, now()->addMinutes(15), function () {
            return $this->getFilteredProducts();
        });

        return view('livewire.filtered-products', [
            'products' => $products,
        ]);
    }

    private function generateCacheKey()
    {
        $filters = [
            'search' => $this->search,
            'sortBy' => $this->sortBy,
            'categories' => implode(',', $this->selectedCategories),
            'onSale' => $this->onSale,
            'inStock' => $this->inStock,
            'page' => $this->page ?? $this->getPage(),
        ];
        return 'filtered_products_' . md5(implode('_', $filters));
    }

    private function getFilteredProducts()
    {
        $currentDate = now();

        $productsQuery = Product::with([
            'category',
            'collection',
            'sales' => fn($query) => $query->where('percentage', '>', 0)
                ->where('start_date', '<=', $currentDate)
                ->where('end_date', '>=', $currentDate),
        ])
            ->when($this->search, fn($query) => $query->where('products.name', 'LIKE', '%' . $this->search . '%'))
            ->when(!empty($this->selectedCategories), fn($query) => $query->whereIn('category_id', $this->selectedCategories))
            ->when($this->onSale, fn($query) => $query->whereHas('sales', function ($saleQuery) use ($currentDate) {
                $saleQuery->where('percentage', '>', 0)
                    ->where('start_date', '<=', $currentDate)
                    ->where('end_date', '>=', $currentDate);
            }))
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
            ->when($this->sortBy, fn($query) => $this->applySorting($query));

        // Paginate results
        $paginatedProducts = $productsQuery->paginate(9);

        // Transform product images
        $paginatedProducts->getCollection()->transform(function ($product) {
            $product->primary_image = $product->getPrimaryImagePath();
            return $product;
        });

        return $paginatedProducts;
    }
    private function applySorting($query)
    {
        return match ($this->sortBy) {
            'lowest_to_highest' => $query->orderBy('discounted_price', 'asc'),
            'highest_to_lowest' => $query->orderBy('discounted_price', 'desc'),
            'best_seller' => $query->orderByDesc('sale_count'),
            default => $query,
        };
    }
}
