<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Units;

use App\Models\ProductUnit;
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
        $unit = ProductUnit::find($unit_id);
        if (!empty($unit)) {
            $this->unit = $unit;
        } else {
            session()->flash('error', 'Unit not found.');
            return $this->redirectRoute('admin.products.units.list', [], navigate: true);
        }
    }
    public function render()
    {
        return view('livewire.panel.admin.product-management.units.details');
    }
}