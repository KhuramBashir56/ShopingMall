<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Products;

use App\Models\Product;
use Livewire\Component;

class Details extends Component
{
    public $product;

    public function mount($product_id)
    {
        $product = Product::find($product_id);
        if (!empty($product)) {
            $this->product = $product;
        } else {
            session()->flash('error', 'Product not found.');
            return $this->redirectRoute('admin.products.list', navigate: true);
        }
    }
    public function render()
    {
        return view('livewire.panel.admin.product-management.products.details');
    }
}
