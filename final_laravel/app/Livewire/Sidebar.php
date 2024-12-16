<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;

class Sidebar extends Component
{
    public $search = '';
    public $sortBy = '';
    public $categories = [];
    public $selectedCategories = [];
    public $onSale = false; // Add this line
    public $inStock = false; // Add this line

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
    public function render()
    {
        logger()->info('Emitting filters:', [
            'search' => $this->search,
            'sortBy' => $this->sortBy,
            'selectedCategories' => $this->selectedCategories,
            'onSale' => $this->onSale,
            'inStock' => $this->inStock,
        ]);
        $this->categories = ProductCategory::all();

        return view('livewire.sidebar', ['categories' => $this->categories]);

    }
}