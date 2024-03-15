<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Products;

use App\Models\Product;
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

    public function visible($index){
        $product = Product::find($index);
        if (!empty($product)) {
            $product->status = 'published';
            $product->save();
            session()->flash('success', 'Product visibility status updated successfully.');
        } else {
            session()->flash('error', 'Product not found.');
        }
    }

    public function invisible($index){
        $product = Product::find($index);
        if (!empty($product)) {
            $product->status = 'unpublished';
            $product->save();
            session()->flash('success', 'Product visibility status updated successfully.');
        } else {
            session()->flash('error', 'Product not found.');
        }
    }

    public function delete($index){
        $product = Product::find($index);
        if (!empty($product)) {
            $product->status = 'deleted';
            $product->save();
            session()->flash('success', 'Product deleted successfully.');
        } else {
            session()->flash('error', 'Product not found.');
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.products.index', [
            'products' => Product::where('status', '!=', 'deleted')->where(function ($query) {
                $query->where('name','LIKE', $this->search . '%');
            })->select('id', 'name', 'thumbnail', 'status')->paginate(50)
        ]);
    }
}