<?php

namespace App\Livewire\Panel\Admin\StockManagement;

use App\Models\Stock;
use App\Models\UserAction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;

class History extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    use WithoutUrlPagination;

    public $search = '';

    public function verify(Stock $stock)
    {
        if ($stock->status == 'verified') {
            session()->flash('error', 'Stock already verified.');
        } else {
            if (empty($stock)) {
                session()->flash('error', 'Stock not found.');
            } else {
                $stock->status = 'verified';
                $stock->update();
                UserAction::create([
                    'user_id' => Auth::id(),
                    'action' => 'stock',
                    'action_id' => $stock->id,
                    'type' => 'verify',
                    'ip' => request()->ip(),
                    'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
                ]);
                session()->flash('success', 'Stock verified successfully.');
            }
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.stock-management.history', [
            'history' => Stock::where('status', '!=', 'deleted')->whereHas('product', function ($query) {
                $query->where('name', 'like', $this->search . '%');
            })->with([
                'product' => function ($product) {
                    $product->select('id', 'unit_id', 'name', 'thumbnail')->with([
                        'unit' => function ($unit) {
                            $unit->select('id', 'code');
                        }
                    ]);
                },
                'price' => function ($price) {
                    $price->select('id', 'stock_id', 'purchase', 'retail', 'wholesale');
                }
            ])->select('id', 'product_id', 'quantity', 'status')->latest()->paginate(50),
        ]);
    }
}