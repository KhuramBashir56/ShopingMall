<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Products;

use App\Models\Product;
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

    public function visible(Product $product)
    {
        if (!empty($product)) {
            $product->status = 'published';
            $product->update();
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'product',
                'action_id' => $product->id,
                'type' => 'visible',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Product visibility status updated successfully.');
        } else {
            session()->flash('error', 'Product not found.');
        }
    }

    public function invisible(Product $product)
    {
        if (!empty($product)) {
            $product->status = 'unpublished';
            $product->update();
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'product',
                'action_id' => $product->id,
                'type' => 'invisible',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Product visibility status updated successfully.');
        } else {
            session()->flash('error', 'Product not found.');
        }
    }

    public function delete(Product $product)
    {
        if (!empty($product)) {
            $product->status = 'deleted';
            $product->update();
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'product',
                'action_id' => $product->id,
                'type' => 'delete',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Product deleted successfully.');
        } else {
            session()->flash('error', 'Product not found.');
        }
    }

    public function edit(Product $product)
    {
        if (!empty($product)) {
            return $this->redirectRoute('admin.products.edit', ['product_id' => $product->id], navigate: true);
        } else {
            session()->flash('error', 'Product not found.');
        }
    }

    public function details(Product $product)
    {
        if (!empty($product)) {
            return $this->redirectRoute('admin.products.details', ['product_id' => $product->id], navigate: true);
        } else {
            session()->flash('error', 'Product not found.');
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.products.index', [
            'products' => Product::where('status', '!=', 'deleted')->where(function ($query) {
                $query->where('name', 'LIKE', $this->search . '%');
            })->with([
                'category' => function ($category) {
                    $category->select('id', 'title');
                },
                'brand' => function ($brand) {
                    $brand->select('id', 'name');
                }
            ])->select('id', 'category_id', 'brand_id', 'name', 'thumbnail', 'status')->paginate(50)
        ]);
    }
}
