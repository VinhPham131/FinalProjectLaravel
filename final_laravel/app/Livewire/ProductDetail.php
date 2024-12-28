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
            ->where('products.id', '!=', $this->product->id) // Exclude the current product
            ->where(function ($query) {
                $query->where('category_id', $this->product->category_id)
                    ->orWhere('collection_id', $this->product->collection_id); // Match either category or collection
            })
            ->select([
                'products.id',
                'products.slug',
                'products.name',
                'products.price',
                'products.category_id',
                DB::raw('MAX(sales.percentage) as highest_sale'),
            ])
            ->join('product_categories', 'product_categories.id', '=', 'products.category_id')
            ->leftJoin('sales', 'sales.name', '=', 'product_categories.name')
            ->groupBy('products.id', 'products.slug', 'products.name', 'products.price', 'products.category_id')
            ->get()
            ->each(function (Product $product) {
                $product->discounted_price = $product->highest_sale
                    ? $product->price * (1 - $product->highest_sale / 100)
                    : $product->price;
            });
    }
    public function addToCart()
    {
        $this->dispatch('addToCart', $this->product->id);
        session()->flash('success', 'Product added to cart.');
        $this->skipRender();
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
