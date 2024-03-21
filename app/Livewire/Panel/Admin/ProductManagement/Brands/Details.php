<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Brands;

use App\Models\Brand;
use Livewire\Component;

class Details extends Component
{

    public $brand;

    public function mount($brand_id)
    {
        $brand = Brand::select('id', 'category_id', 'author_id', 'name', 'thumbnail', 'status', 'description', 'meta_keywords', 'meta_description', 'created_at')->find($brand_id);

        if ($brand) {
            $this->brand = $brand;
        } else {
            session()->flash('error', 'Brand not found.');
            return redirect()->route('admin.brands.list')->with('navigate', true);
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.brands.details');
    }
}
