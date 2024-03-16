<?php

namespace App\Livewire\Panel\Admin\StockManagement\Units;

use App\Models\StockUnit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    public $unit_id, $title, $code, $description = '';

    public function mount($unit_id)
    {
        $unit = StockUnit::find($unit_id);
        if (!empty($unit)) {
            $this->unit_id = $unit->id;
            $this->title = $unit->title;
            $this->code = $unit->code;
            $this->description = $unit->description;
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }

    public function cancel()
    {
        $this->reset(['unit_id', 'title', 'code', 'description']);
        return $this->redirectRoute('admin.stock-management.units.list', [], navigate: true);
    }

    public function update($unit_id)
    {
        $unit = StockUnit::find($unit_id);
        if (!empty($unit)) {
            $unit->title = $this->title;
            $unit->code = $this->code;
            $unit->description = $this->description;
            $unit->author_id = Auth::user()->id;
            $unit->update();
            session()->flash('success', 'Unit information updated successfully.');
            return $this->redirectRoute('admin.stock-management.units.list', [], navigate: true);
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.stock-management.units.edit');
    }
}