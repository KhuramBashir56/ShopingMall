<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Brands;

use App\Models\Brand;
use Livewire\Component;

class Details extends Component
{

    public function __construct()
    {
        $this->authorize('admin');
    }

    public $brand;

    public function mount($brand_id)
    {
        $this->brand = Brand::select('id', 'category_id', 'author_id', 'name', 'thumbnail', 'status', 'description', 'meta_keywords', 'meta_description', 'created_at')->find($brand_id);
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.brands.details');
    }
}