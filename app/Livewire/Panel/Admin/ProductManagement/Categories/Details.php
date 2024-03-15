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

    public $category_id, $category = '';

    public function mount($category_id)
    {
        $this->category = Category::select('id', 'author_id', 'title', 'thumbnail', 'status', 'description', 'meta_keywords', 'meta_description', 'meta_description', 'created_at')->find($category_id);

        if (!$this->category_id) {
            session()->flash('error', 'Category not found.');
            return $this->redirectRoute('admin.categories.list', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.categories.details');
    }
}