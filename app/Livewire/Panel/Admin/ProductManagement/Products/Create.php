<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\UserAction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $category_id, $brand_id, $unit_id, $name, $thumbnail, $description, $keyword, $meta_keywords, $meta_description;

    public $keywords = [];

    public $brands = [];

    public function addKeyword()
    {
        $this->keyword = trim($this->keyword);
        if ($this->keyword) {
            if (!in_array($this->keyword, $this->keywords)) {
                $this->keywords[] = $this->keyword;
            } else {
                session()->flash('error', 'The keyword "' . $this->keyword . '"  already exists in the list.');
            }
        } else {
            $this->validate([
                'meta_keywords' => ['required', 'string', 'max:255']
            ]);
        }
        $this->reset(['keyword']);
    }

    public function removeKeyword($index)
    {
        unset($this->keywords[$index]);
        $this->keywords = array_values($this->keywords);
    }

    public function cancel()
    {
        $this->keywords = [];
        $this->brands = [];
        $this->reset(['category_id', 'brand_id', 'name', 'thumbnail', 'description', 'keyword', 'meta_keywords', 'meta_description']);
        return $this->redirectRoute('admin.products.list', navigate: true);
    }

    public function store()
    {
        if (empty($this->keywords)) {
            $this->addKeyword();
        } else {
            $this->meta_keywords = !empty($this->keywords) ? implode(', ', $this->keywords) : NULL;
            $this->validate([
                'category_id' => ['required', 'integer', 'min:1', 'exists:categories,id'],
                'brand_id' => ['required', 'integer', 'min:1', 'exists:brands,id'],
                'unit_id' => ['required', 'integer', 'min:1', 'exists:product_units,id'],
                'name' => ['required', 'string', 'max:24', 'unique:products,name'],
                'thumbnail' => [
                    'required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:512',
                    // 'dimensions:min_width=440,min_height=248,max_width=1280,max_height=720'
                ],
                'description' => ['required', 'string', 'max:500'],
                'meta_keywords' => ['required', 'string', 'max:255'],
                'meta_description' => ['required', 'string', 'max:160'],
            ], [
                'thumbnail.dimensions' => 'The thumbnail must have dimensions between 440x248 and 1280x720 with a 16:9 aspect ratio.',
            ]);
            $product = Product::create([
                'author_id' => 1,
                'category_id' => $this->category_id,
                'brand_id' => $this->brand_id,
                'unit_id' => $this->unit_id,
                'name' => trim($this->name),
                'thumbnail' => $this->thumbnail->store('uploads/products', 'public'),
                'description' => trim($this->description),
                'slug' => str_replace(' ', '-', trim($this->name)),
                'meta_keywords' => $this->meta_keywords,
                'meta_description' => trim($this->meta_description),
            ]);
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'product',
                'action_id' => $product->id,
                'type' => 'create',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Data saved new product add successfully.');
            $this->cancel();
        }
    }

    public function render()
    {
        if (!empty($this->category_id)) {
            $this->brands = Brand::where('status', 'published')->where('category_id', $this->category_id)->get();
        } else {
            $this->brands = [];
        }

        return view('livewire.panel.admin.product-management.products.create', [
            'categories' => Category::has('brands')->where('status', 'published')->select('id', 'title')->get(),
            'brands' => $this->brands,
            'units' => ProductUnit::where('status', 'published')->select('id', 'title', 'code')->get()
        ]);
    }
}
