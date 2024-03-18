<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Categories;

use App\Models\Category;
use App\Models\UserAction;
use Illuminate\Support\Facades\Auth;
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

    public function visible(Category $category)
    {
        if (!empty($category)) {
            $category->status = 'published';
            $category->update();
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'product_category',
                'action_id' => $category->id,
                'type' => 'visible',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Category visibility status updated successfully.');
        } else {
            session()->flash('error', 'Category not found.');
        }
    }

    public function invisible(Category $category)
    {
        if (!empty($category)) {
            $category->status = 'unpublished';
            $category->update();
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'product_category',
                'action_id' => $category->id,
                'type' => 'invisible',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Category visibility status updated successfully.');
        } else {
            session()->flash('error', 'Category not found.');
        }
    }

    public function delete(Category $category)
    {
        if (!empty($category)) {
            $category->status = 'deleted';
            $category->update();
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'product_category',
                'action_id' => $category->id,
                'type' => 'delete',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Category record deleted successfully.');
        } else {
            session()->flash('error', 'Category not found.');
        }
    }

    public function details(Category $category)
    {
        if (!empty($category)) {
            $this->redirectRoute('admin.categories.details', ['category_id' => $category->id], navigate: true);
        } else {
            session()->flash('error', 'Category not found.');
        }
    }

    public function edit(Category $category)
    {
        if (!empty($category)) {
            $this->redirectRoute('admin.categories.edit', ['category_id' => $category->id], navigate: true);
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