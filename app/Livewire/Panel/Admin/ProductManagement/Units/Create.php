<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Units;

use App\Models\ProductUnit;
use App\Models\UserAction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    public $title, $code, $description = '';

    public function cancel()
    {
        $this->reset('title', 'code', 'description');
        return $this->redirectRoute('admin.products.units.list', navigate: true);
    }

    public function store()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:48', 'unique:product_units,title'],
            'code' => ['required', 'string', 'max:2', 'unique:product_units,code', 'regex:/[A-Z]{2}/'],
            'description' => ['required', 'string', 'max:500'],
        ], [
            'code.regex' => 'The code must be two letters and uppercase A-Z.'
        ]);
        $unit = ProductUnit::create([
            'title' => $this->title,
            'code' => $this->code,
            'description' => $this->description,
            'author_id' => Auth::user()->id
        ]);
        UserAction::create([
            'user_id' => Auth::id(),
            'action' => 'product_unit',
            'action_id' => $unit->id,
            'type' => 'create',
            'ip' => request()->ip(),
            'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
        ]);
        session()->flash('success', 'Unit record created successfully.');
        $this->cancel();
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.units.create');
    }
}