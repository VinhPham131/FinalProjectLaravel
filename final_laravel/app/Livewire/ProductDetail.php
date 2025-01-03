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
        $this->product = $product->load('images');
    }
    public function addToCart()
    {
        $this->dispatch('addToCart', $this->product->id); // Emit event to Cart component
        $this->dispatch('cartUpdated'); // Dispatch for UI updates
        session()->flash('success', 'Product added to cart.');
        $this->skipRender();
    }


    public function render()
    {
        return view('livewire.product-detail', [
            'product' => $this->product,
            'relatedProducts' => $this->relatedProducts,
        ]);
    }
}
