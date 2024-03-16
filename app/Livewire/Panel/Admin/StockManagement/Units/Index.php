<?php

namespace App\Livewire\Panel\Admin\StockManagement\Units;

use App\Models\StockUnit;
use Livewire\Component;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    use WithoutUrlPagination;

    public $search = '';

    public function visible($unit_id)
    {
        $unit = StockUnit::find($unit_id);
        if (!empty($unit)) {
            $unit->status = 'published';
            $unit->save();
            session()->flash('success', 'Unit visibility status updated successfully.');
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }

    public function invisible($unit_id)
    {
        $unit = StockUnit::find($unit_id);
        if (!empty($unit)) {
            $unit->status = 'unpublished';
            $unit->save();
            session()->flash('success', 'Unit visibility status updated successfully.');
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }

    public function delete($unit_id)
    {
        $unit = StockUnit::find($unit_id);
        if (!empty($unit)) {
            $unit->status = 'deleted';
            $unit->save();
            session()->flash('success', 'Unit deleted successfully.');
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }

    public function edit($unit_id)
    {
        $unit = StockUnit::find($unit_id);
        if (!empty($unit)) {
            return $this->redirectRoute('admin.stock-management.units.edit', ['unit_id' => $unit_id], navigate: true);
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }

    public function details($unit_id)
    {
        $unit = StockUnit::find($unit_id);
        if (!empty($unit)) {
            return $this->redirectRoute('admin.stock-management.units.details', ['unit_id' => $unit_id], navigate: true);
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.stock-management.units.index', [
            'units' => StockUnit::where('status', '!=', 'deleted')->whereAny(['title', 'code'], 'LIKE', $this->search . '%')->select('id', 'title', 'code', 'status')->orderBy('title', 'asc')->paginate(50)
        ]);
    }
}