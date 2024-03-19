<?php

namespace App\Livewire\Panel\Admin\StockManagement;

use App\Models\Price;
use App\Models\Product;
use App\Models\UserAction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChangePrice extends Component
{

    public function __construct()
    {
        $this->authorize('admin');
    }

    public $product_id, $purchase, $wholesale, $retail = '';

    public function mount(Product $product)
    {
        $this->purchase = $product->price->purchase;
        $this->wholesale = $product->price->wholesale;
        $this->retail = $product->price->retail;
        $this->product_id = $product->id;
    }

    public function updatePrice(Product $product)
    {
        $verify_price = $product->price;
        if ($verify_price->purchase != $this->purchase || $verify_price->wholesale != $this->wholesale || $verify_price->retail != $this->retail) {
            $this->validate([
                'product_id' => ['required', 'exists:products,id'],
                'purchase' => ['required', 'min:1', 'max:9999999', 'int', 'lte:' . $this->retail, 'lte:' . $this->wholesale],
                'wholesale' => ['required', 'min:1', 'max:9999999', 'int', 'lte:' . $this->retail, 'gte:' . $this->purchase],
                'retail' => ['required', 'min:1', 'max:9999999', 'int', 'gte:' . $this->wholesale, 'gte:' . $this->purchase],
            ]);
            $price = Price::create([
                'product_id' => $product->id,
                'purchase' => $this->purchase,
                'wholesale' => $this->wholesale,
                'retail' => $this->retail,
                'author_id' => Auth::id(),
            ]);
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'Price',
                'action_id' => $price->id,
                'type' => 'change',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
        }
        $this->reset(['product_id', 'purchase', 'wholesale', 'retail']);
        $this->dispatch('priceChanged');
    }
    public function render()
    {
        return view('livewire.panel.admin.stock-management.change-price');
    }
}