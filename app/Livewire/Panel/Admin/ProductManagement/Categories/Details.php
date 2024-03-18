<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Categories;

use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Details extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    public $category = '';

    public function mount($category_id)
    {
        $category = Category::select('id', 'author_id', 'title', 'thumbnail', 'status', 'description', 'meta_keywords', 'meta_description', 'created_at')->find($category_id);

        if (!$category) {
            session()->flash('error', 'Category not found.');
            return redirect()->route('admin.categories.list')->with('navigate', true);
        }

        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.categories.details');
    }
}