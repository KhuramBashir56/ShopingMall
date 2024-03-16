<?php

namespace App\Livewire\Panel\Admin\StockManagement\Units;

use App\Models\StockUnit;
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
        return $this->redirectRoute('admin.stock-management.units.list', navigate: true);
    }

    public function store()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:48', 'unique:stock_units,title'],
            'code' => ['required', 'string', 'max:2', 'unique:stock_units,code', 'regex:/[A-Z]{2}/'],
            'description' => ['required', 'string', 'max:500'],
        ], [
            'code.regex' => 'The code must be two letters and uppercase A-Z.'
        ]);

        StockUnit::create([
            'title' => $this->title,
            'code' => $this->code,
            'description' => $this->description,
            'author_id' => Auth::user()->id
        ]);
        session()->flash('success', 'Unit record created successfully.');
        $this->cancel();
    }

    public function render()
    {
        return view('livewire.panel.admin.stock-management.units.create');
    }
}