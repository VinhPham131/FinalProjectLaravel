<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

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
        $products = Product::with(['images', 'category', 'collection'])
            ->when($this->search, fn($query) => $query->where('products.name', 'LIKE', '%' . $this->search . '%'))
            ->when(!empty($this->selectedCategories), fn($query) => $query->whereIn('category_id', $this->selectedCategories))
            ->when($this->onSale, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('category.sales', function ($saleQuery) {
                        $saleQuery->where('sales.sale_target', 'category')
                            ->where('sales.percentage', '>', 0);
                    })
                        ->orWhereHas('collection.sales', function ($saleQuery) {
                            $saleQuery->where('sales.sale_target', 'collection')
                                ->where('sales.percentage', '>', 0);
                        });
                });
            })
            ->when($this->inStock, fn($query) => $query->where('quantity', '>', 0))
            ->when($this->sortBy, function ($query) {
                match ($this->sortBy) {
                    'lowest_to_highest' => $query->orderBy(DB::raw('
                    CASE 
                        WHEN MAX(sales.percentage) > 0 
                        THEN products.price - (products.price * MAX(sales.percentage) / 100) 
                        ELSE products.price 
                    END
                '), 'asc'),
                    'highest_to_lowest' => $query->orderBy(DB::raw('
                    CASE 
                        WHEN MAX(sales.percentage) > 0 
                        THEN products.price - (products.price * MAX(sales.percentage) / 100) 
                        ELSE products.price 
                    END
                '), 'desc'),
                    'best_seller' => $query->orderBy('sale_count', 'desc'),
                    default => null,
                };
            })
            ->select(
                'products.*',
                DB::raw('MAX(sales.percentage) as highest_sale'),
                DB::raw('
                CASE 
                    WHEN MAX(sales.percentage) > 0 
                    THEN products.price - (products.price * MAX(sales.percentage) / 100) 
                    ELSE products.price 
                END as discounted_price
            ')
            )
            ->leftJoin('product_categories', 'product_categories.id', '=', 'products.category_id')
            ->leftJoin('collections', 'collections.id', '=', 'products.collection_id')
            ->leftJoin('sales', function ($join) {
                $join->on('sales.name', '=', 'product_categories.name')
                    ->where('sales.sale_target', '=', 'category')
                    ->orWhere(function ($query) {
                        $query->on('sales.name', '=', 'collections.name')
                            ->where('sales.sale_target', '=', 'collection');
                    });
            })
            ->groupBy('products.id')
            ->paginate(9);

        return view('livewire.filtered-products', [
            'products' => $products,
        ]);
    }


}
