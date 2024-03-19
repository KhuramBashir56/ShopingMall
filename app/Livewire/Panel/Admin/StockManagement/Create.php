<?php

namespace App\Livewire\Panel\Admin\StockManagement;

use App\Models\Price;
use App\Models\Product;
use App\Models\Stock;
use App\Models\UserAction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    public $supplier_name, $invoice, $delivery, $item_id, $item_name, $purchase_price, $purchase_total, $price, $whole_sale, $expiry_date, $remarks = '';

    public $items = [];

    public $total = 0;

    public $quantity = 1;

    public $products_list = false;

    public function quantity_decrement()
    {
        if ($this->quantity <= 1) {
            $this->quantity = 1;
        } else {
            $this->quantity--;
        }
    }

    public function quantity_increment()
    {
        if ($this->quantity >= 999) {
            $this->quantity = 999;
        } else {
            $this->quantity++;
        }
    }

    public function search_item()
    {
        $this->products_list = true;
    }

    public function select_item($item_id)
    {
        $exist_item = in_array($item_id, array_column($this->items, 0));
        if ($exist_item) {
            $this->products_list = false;
            $this->reset('item_id', 'item_name', 'price', 'whole_sale', 'purchase_price');
            session()->flash('error', 'Product already added.');
        } else {
            $this->item_id = $item_id;
            $this->item_name = Product::find($item_id)->name;
            $this->price = Price::where('product_id', $item_id)->latest()->first()->retail ?? 0;
            $this->whole_sale = Price::where('product_id', $item_id)->latest()->first()->wholesale ?? 0;
            $this->products_list = false;
        }
    }

    public function remove_item($index)
    {
        $this->total = $this->total - $this->items[$index][7];
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function add_item()
    {
        $this->validate([
            'item_id' => ['required', 'min:1', 'exists:products,id'],
            'item_name' => ['required', 'string', 'max:48'],
            'expiry_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:' . date('Y-m-d')],
            'quantity' => ['required', 'min:1', 'max:999', 'int'],
            'purchase_price' => ['required', 'min:1', 'max:9999999', 'int', 'lte:' . $this->price, 'lte:' . $this->whole_sale],
            'whole_sale' => ['required', 'min:1', 'max:9999999', 'int', 'lte:' . $this->price, 'gte:' . $this->purchase_price],
            'price' => ['required', 'min:1', 'max:9999999', 'int', 'gte:' . $this->whole_sale, 'gte:' . $this->purchase_price],
        ]);
        $this->items[] = [
            $this->item_id, //[0]
            $this->item_name, //[1]
            $this->quantity, //[2]
            $this->expiry_date, //[3]
            $this->purchase_price, //[4]
            $this->whole_sale, //[5]
            $this->price, //[6]
            $this->purchase_total = $this->purchase_price * $this->quantity, //[7] 
        ];
        $this->total = $this->total + $this->purchase_total;
        $this->reset(['item_id', 'item_name', 'purchase_price', 'purchase_total', 'price', 'whole_sale', 'expiry_date', 'quantity']);
    }

    public function cancel()
    {
        $this->products_list = false;
        $this->items = [];
        $this->total = 0;
        $this->quantity = 1;
        $this->reset(['supplier_name', 'invoice', 'delivery', 'item_id', 'item_name', 'purchase_price', 'purchase_total', 'price', 'whole_sale', 'expiry_date', 'quantity', 'remarks']);
        return $this->redirectRoute('admin.stock-management.history', navigate: true);
    }

    public function store()
    {
        if (empty($this->items)) {
            $this->add_item();
        } else {
            $this->validate([
                'supplier_name' => ['required', 'string', 'max:48'],
                'invoice' => ['required', 'string', 'max:48'],
                'delivery' => ['required', 'date', 'before_or_equal:' . date('Y-m-d')],
                'remarks' => ['required', 'string', 'max:255'],
            ]);
            foreach ($this->items as $item) {
                $stock = Stock::create([
                    'product_id' => $item[0],
                    'supplier_name' => $this->supplier_name,
                    'supplied_at' => $this->delivery,
                    'invoice_Id' => $this->invoice,
                    'quantity' => $item[2],
                    'expiry_date' => $item[3],
                    'author_id' => Auth::user()->id,
                    'remarks' => $this->remarks,
                ]);
                $stock_id = $stock->id;
                Price::create([
                    'product_id' => $item[0],
                    'stock_id' => $stock_id,
                    'purchase' => $item[4],
                    'wholesale' => $item[5],
                    'retail' => $item[6],
                    'author_id' => Auth::user()->id,
                ]);
                UserAction::create([
                    'user_id' => Auth::id(),
                    'action' => 'stock',
                    'action_id' => $stock_id,
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
                ]);
            }
            session()->flash('success', 'New stock added successfully. Please check the history.');
            $this->cancel();
        }
    }

    public function render()
    {
        if (!empty($this->item_name)) {
            $products = Product::where('status', 'published')->where('name', 'LIKE', $this->item_name . '%')->select('id', 'name')->orderBy('name', 'asc')->get();
        } else {
            $products = [];
        }
        return view('livewire.panel.admin.stock-management.create', [
            'products' => $products
        ]);
    }
}