<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class Products extends Component
{
    public $products = [];  // Danh sách sản phẩm hiển thị
    public $limit = 8;      // Số lượng sản phẩm hiển thị ban đầu
    public $totalProducts;  // Tổng số sản phẩm

    public function mount()
    {
        $this->totalProducts = Product::count(); // Tổng số sản phẩm trong database
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $this->products = Product::with(['images', 'category', 'collection'])
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
            ->take($this->limit)
            ->get();
    }

    public function showMore()
    {
        $this->limit += 8; // Tăng giới hạn hiển thị mỗi lần nhấn nút
        $this->loadProducts();
    }

    public function showLess()
    {
        $this->limit = max(8, $this->limit - 8); // Giảm giới hạn hiển thị, nhưng không thấp hơn 8
        $this->loadProducts();
    }

    public function render()
    {
        return view('livewire.products', [
            'products' => $this->products,
            'totalProducts' => $this->totalProducts,
        ]);
    }
}
