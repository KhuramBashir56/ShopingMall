<?php

namespace App\Livewire\Panel\Admin\StockManagement;

use App\Models\Stock;
use Livewire\Component;

class Details extends Component
{
    public $stock = '';

    public function mount($stock_id)
    {
        $stock = Stock::find($stock_id);
        if (empty($stock)) {
            return $this->redirectRoute('admin.stock-management.history', navigate: true);
            session()->flash('error', 'Stock not found.');
        } else {
            $this->stock = $stock;
        }
    }
    public function render()
    {
        return view('livewire.panel.admin.stock-management.details');
    }
}