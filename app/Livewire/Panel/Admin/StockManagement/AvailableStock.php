<?php

namespace App\Livewire\Panel\Admin\StockManagement;

use App\Models\Product;
use Livewire\Component;

class AvailableStock extends Component
{
    public function render()
    {
        return view('livewire.panel.admin.stock-management.available-stock', [
            'stock' => Product::where('status', 'published')->with([
                'stock' => function ($stock) {
                    $stock->select('id', 'product_id', 'unit_id', 'quantity')->with([
                        'unit' => function ($unit) {
                            $unit->select('id', 'code');
                        }
                    ]);
                },
                'price' => function ($price) {
                    $price->select('id', 'product_id', 'purchase', 'retail', 'wholesale');
                }
            ])->orderBy('name', 'asc')->paginate(50)
        ]);
    }
}