<?php

namespace App\Livewire;

use Livewire\Component;
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
        $this->products = Product::with('images')->take($this->limit)->get()->map(function ($product) {
            $product->highest_sale = $product->highestSale();
            $product->discounted_price = $product->salePrice();
            return $product;
        });
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

