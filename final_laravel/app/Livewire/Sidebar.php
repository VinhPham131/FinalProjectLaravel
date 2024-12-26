<?php

namespace App\Livewire;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Sidebar extends Component
{
    public $search = '';
    public $sortBy = '';
    public $selectedCategories = [];
    public $onSale = false;
    public $inStock = false;

    protected $listeners = ['filterUpdated'];

    public function updated($propertyName)
    {
        // Check if the property name starts with 'selectedCategories'
        $isSelectedCategory = strpos($propertyName, 'selectedCategories') === 0;

        if (in_array($propertyName, ['search', 'sortBy', 'onSale', 'inStock']) || $isSelectedCategory) {
            $this->dispatch('filterUpdated', [
                'search' => $this->search,
                'sortBy' => $this->sortBy,
                'selectedCategories' => $this->selectedCategories,
                'onSale' => $this->onSale,
                'inStock' => $this->inStock,
            ]);
        }
    }

    public function removeCategory($categoryId)
    {
        $this->selectedCategories = array_filter($this->selectedCategories, function ($id) use ($categoryId) {
            return $id != $categoryId;
        });
        $this->updated('selectedCategories');
    }

    public function clearSortBy()
    {
        $this->sortBy = '';
        $this->updated('sortBy');
    }

    public function toggleOnSale()
    {
        $this->onSale = !$this->onSale;
        $this->updated('onSale');
    }

    public function toggleInStock()
    {
        $this->inStock = !$this->inStock;
        $this->updated('inStock');
    }

    public function render()
    {
        logger()->info('Emitting filters:', [
            'search' => $this->search,
            'sortBy' => $this->sortBy,
            'selectedCategories' => $this->selectedCategories,
            'onSale' => $this->onSale,
            'inStock' => $this->inStock,
        ]);

        //reduce cache to 5 instead of 60 to reflect changes from filament!
        $categories = Cache::remember('categories', 5, callback: function () {
            return ProductCategory::all();
        });

        return view('livewire.sidebar', ['categories' => $categories, 'sortBy' => $this->sortBy, 'selectedCategories' => $this->selectedCategories]);
    }
}
