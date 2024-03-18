<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Units;

use App\Models\ProductUnit;
use App\Models\UserAction;
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
        $unit = ProductUnit::find($unit_id);
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
        return $this->redirectRoute('admin.products.units.list', [], navigate: true);
    }

    public function update(ProductUnit $unit)
    {
        if (!empty($unit)) {
            $unit->title = $this->title;
            $unit->code = $this->code;
            $unit->description = $this->description;
            $unit->author_id = Auth::user()->id;
            $unit->update();
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'product_unit',
                'action_id' => $unit->id,
                'type' => 'update',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Unit information updated successfully.');
            $this->cancel();
        } else {
            session()->flash('error', 'Unit not found.');
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.units.edit');
    }
}