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

    protected $listeners = ['filterUpdated'];

    public function mount()
    {
        $this->categories = ProductCategory::all();
    }

    public function updated($propertyName)
    {
        logger("Emitting filterUpdated with search: {$this->search}");
        if (in_array($propertyName, ['search', 'sortBy', 'selectedCategories'])) {
            $this->dispatch('filterUpdated', [
                'search' => $this->search,
                'sortBy' => $this->sortBy,
                'selectedCategories' => $this->selectedCategories,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.sidebar', [
            'categories' => $this->categories,
        ]);
    }
}