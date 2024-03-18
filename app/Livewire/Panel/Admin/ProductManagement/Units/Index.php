<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Units;

use App\Models\ProductUnit;
use App\Models\UserAction;
use Illuminate\Support\Facades\Auth;
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

    public function visible(ProductUnit $unit)
    {
        if (!empty($unit)) {
            $unit->status = 'published';
            $unit->update();
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'product_unit',
                'action_id' => $unit->id,
                'type' => 'visible',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Unit visibility status updated successfully.');
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }

    public function invisible(ProductUnit $unit)
    {
        if (!empty($unit)) {
            $unit->status = 'unpublished';
            $unit->update();
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'product_unit',
                'action_id' => $unit->id,
                'type' => 'invisible',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Unit visibility status updated successfully.');
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }

    public function delete(ProductUnit $unit)
    {
        if (!empty($unit)) {
            $unit->status = 'deleted';
            $unit->update();
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'product_unit',
                'action_id' => $unit->id,
                'type' => 'delete',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Unit deleted successfully.');
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }

    public function edit(ProductUnit $unit)
    {
        if (!empty($unit)) {
            return $this->redirectRoute('admin.products.units.edit', ['unit_id' => $unit->id], navigate: true);
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }

    public function details(ProductUnit $unit)
    {
        if (!empty($unit)) {
            return $this->redirectRoute('admin.products.units.details', ['unit_id' => $unit->id], navigate: true);
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.units.index', [
            'units' => ProductUnit::where('status', '!=', 'deleted')->whereAny(['title', 'code'], 'LIKE', $this->search . '%')->select('id', 'title', 'code', 'status')->orderBy('title', 'asc')->paginate(50)
        ]);
    }
}