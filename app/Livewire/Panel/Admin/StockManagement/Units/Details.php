<?php

namespace App\Livewire\Panel\Admin\StockManagement\Units;

use App\Models\StockUnit;
use Livewire\Component;

class Details extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    public $unit;

    public function mount($unit_id)
    {
        $unit = StockUnit::find($unit_id);
        if (!empty($unit)) {
            $this->unit = $unit;
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }
    public function render()
    {
        return view('livewire.panel.admin.stock-management.units.details');
    }
}