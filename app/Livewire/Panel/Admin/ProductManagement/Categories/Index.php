<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    use WithPagination;

    public $search = '';

    public function visible($index)
    {
        $category = Category::find($index);
        if (!empty($category)) {
            $category->status = 'published';
            $category->save();
            session()->flash('success', 'Category visibility status updated successfully.');
        } else {
            session()->flash('error', 'Category not found.');
        }
    }

    public function invisible($index)
    {
        $category = Category::find($index);
        if (!empty($category)) {
            $category->status = 'unpublished';
            $category->save();
            session()->flash('success', 'Category visibility status updated successfully.');
        } else {
            session()->flash('error', 'Category not found.');
        }
    }

    public function delete($index)
    {
        $category = Category::find($index);
        if (!empty($category)) {
            $category->status = 'deleted';
            $category->deleted_at = now();
            $category->save();
            session()->flash('success', 'Category record deleted successfully.');
        } else {
            session()->flash('error', 'Category not found.');
        }
    }

    public function details($index)
    {
        $category = Category::find($index);
        if (!empty($category)) {
            $this->redirectRoute('admin.categories.details', ['category_id' => $index], navigate: true);
        } else {
            session()->flash('error', 'Category not found.');
        }
    }

    public function edit($index)
    {
        $category = Category::find($index);
        if (!empty($category)) {
            $this->redirectRoute('admin.categories.edit', ['category_id' => $index], navigate: true);
        } else {
            session()->flash('error', 'Category not found.');
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.categories.index', [
            'categories' => Category::select('id', 'title', 'thumbnail', 'status')->where(function ($query) {
                $query->where('status', '!=', 'deleted')->where('title', 'LIKE', $this->search . '%');
            })->orderBy('title', 'asc')->paginate(50),
        ]);
    }
}