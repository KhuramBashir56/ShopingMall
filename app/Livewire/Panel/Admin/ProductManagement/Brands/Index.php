<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Brands;

use App\Models\Brand;
use App\Models\UserAction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    use WithoutUrlPagination;

    public $search, $searchOption = '';

    public function visible(Brand $brand)
    {
        if (!empty($brand)) {
            $brand->status = 'published';
            $brand->update();
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'brand',
                'action_id' => $brand->id,
                'type' => 'visible',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Brand visibility status updated successfully.');
        } else {
            session()->flash('error', 'Brand not found.');
        }
    }

    public function invisible(Brand $brand)
    {
        if (!empty($brand)) {
            $brand->status = 'unpublished';
            $brand->update();
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'brand',
                'action_id' => $brand->id,
                'type' => 'invisible',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Brand visibility status updated successfully.');
        } else {
            session()->flash('error', 'Brand not found.');
        }
    }

    public function delete(Brand $brand)
    {
        if (!empty($brand)) {
            $brand->status = 'deleted';
            $brand->update();
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'brand',
                'action_id' => $brand->id,
                'type' => 'delete',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Brand deleted successfully.');
        } else {
            session()->flash('error', 'Brand not found.');
        }
    }

    public function details(Brand $brand)
    {
        if (!empty($brand)) {
            return $this->redirectRoute('admin.brands.details', ['brand_id' => $brand->id], navigate: true);
        } else {
            session()->flash('error', 'Brand not found.');
        }
    }

    public function edit(Brand $brand)
    {
        if (!empty($brand)) {
            return $this->redirectRoute('admin.brands.edit', ['brand_id' => $brand->id], navigate: true);
        } else {
            session()->flash('error', 'Brand not found.');
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.brands.index', [
            'brands' => Brand::with(['category' => function ($category) {
                $category->select('id', 'title');
            }])->select('id', 'category_id', 'name', 'thumbnail', 'status')->where(function ($query) {
                $query->where('status', '!=', 'deleted')->where('name', 'LIKE', $this->search . '%');
            })->paginate(50),
        ]);
    }
}