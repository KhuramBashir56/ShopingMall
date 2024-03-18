<?php

namespace App\Livewire\Panel\Admin\StockManagement;

use App\Models\Stock;
use Livewire\Component;

class History extends Component
{
    public function render()
    {
        return view('livewire.panel.admin.stock-management.history', [
            'history' => Stock::where('status', '!=', 'deleted')->with([
                'product' => function ($product) {
                    $product->select('id', 'name', 'thumbnail');
                },
                'unit' => function ($unit) {
                    $unit->select('id', 'code');
                },
                'price' => function ($price) {
                    $price->select('id', 'stock_id', 'purchase', 'retail', 'wholesale');
                }

            ])->select('id', 'product_id', 'unit_id', 'quantity', 'status')->latest()->paginate(50),
        ]);
    }
}