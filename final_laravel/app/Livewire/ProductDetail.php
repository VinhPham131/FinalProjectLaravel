<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;
    public $relatedProducts;

    public function mount(Product $product)
    {
        $this->product = $product;

        // Tính toán giá giảm cho sản phẩm chính
        $this->calculateSaleAttributes($this->product);

        // Lấy các sản phẩm liên quan
        $this->relatedProducts = Product::with('images')
            ->select([
                'products.id',
                'products.slug',
                'products.name',
                'products.price',
                'products.category_id',
                DB::raw('MAX(sales.percentage) as highest_sale'),
            ])
            ->join('product_categories', 'product_categories.id', '=', 'products.category_id')
            ->join('sales', 'sales.name', '=', 'product_categories.name')
            ->groupBy('products.id', 'products.slug', 'products.name', 'products.price', 'products.category_id')
            ->get()
            ->each(function (Product $product) {
                $product->discounted_price = $product->highest_sale
                    ? $product->price * (1 - $product->highest_sale / 100)
                    : $product->price;
            });
    }

    private function calculateSaleAttributes($product)
    {
        $product->highest_sale = $product->highestSale();
        $product->discounted_price = $product->salePrice();
    }

    public function render()
    {
        return view('livewire.product-detail', [
            'product' => $this->product,
            'relatedProducts' => $this->relatedProducts,
        ]);
    }
}
