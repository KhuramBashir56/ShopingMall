<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Brands;

use App\Models\Brand;
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

    public function invisible($index)
    {
        $brand = Brand::find($index);
        if (!empty($brand)) {
            $brand->status = 'unpublished';
            $brand->save();
            session()->flash('success', 'Brand visibility status updated successfully.');
        } else {
            session()->flash('error', 'Brand not found.');
        }
    }

    public function visible($index)
    {
        $brand = Brand::find($index);
        if (!empty($brand)) {
            $brand->status = 'published';
            $brand->save();
            session()->flash('success', 'Brand visibility status updated successfully.');
        } else {
            session()->flash('error', 'Brand not found.');
        }
    }

    public function delete($index)
    {
        $brand = Brand::find($index);
        if (!empty($brand)) {
            $brand->status = 'deleted';
            $brand->save();
            session()->flash('success', 'Brand deleted successfully.');
        } else {
            session()->flash('error', 'Brand not found.');
        }
    }

    public function details($index)
    {
        $brand = Brand::find($index);
        if (!empty($brand)) {
            return $this->redirectRoute('admin.brands.details', ['brand_id' => $index], navigate: true);
        } else {
            session()->flash('error', 'Brand not found.');
        }
    }

    public function edit($index)
    {
        $brand = Brand::find($index);
        if (!empty($brand)) {
            return $this->redirectRoute('admin.brands.edit', ['brand_id' => $index], navigate: true);
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