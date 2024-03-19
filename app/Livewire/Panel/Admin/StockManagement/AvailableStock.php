<?php

namespace App\Livewire\Panel\Admin\StockManagement;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AvailableStock extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    use WithPagination;

    public $product = '';

    public $changePriceForm = false;

    protected $listeners = [
        'priceChanged'
    ];

    public function changePrice(Product $product)
    {
        if (empty($product)) {
            session()->flash('error', 'Product not found.');
        } else {
            $this->product = $product->id;
            $this->changePriceForm = true;
        }
    }

    public function priceChanged()
    {
        $this->changePriceForm = false;
        $this->product = '';
        session()->flash('success', 'Price changed successfully.');
    }


    public function cancel()
    {
        $this->changePriceForm = false;
        $this->product = '';
    }

    public function render()
    {
        return view('livewire.panel.admin.stock-management.available-stock', [
            'stock' => Product::whereHas('stock', function ($stock) {
                $stock->where('status', 'verified');
            })->where('status', 'published')->with([
                'stock' => function ($stock) {
                    $stock->select('id', 'product_id', 'quantity')->where('status', 'verified');
                },
                'price' => function ($price) {
                    $price->select('id', 'product_id', 'purchase', 'retail', 'wholesale');
                },
                'unit' => function ($unit) {
                    $unit->select('id', 'code');
                }
            ])->orderBy('name', 'asc')->paginate(50)
        ]);
    }
}