<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    use WithFileUploads;

    public $category_id, $brand_id, $product_id, $name, $oldThumbnail, $thumbnail, $description, $meta_keywords, $keyword, $meta_description = '';

    public $keywords = [];

    public $brands = [];

    public function mount($product_id)
    {
        $product = Product::find($product_id);
        if (!empty($product)) {
            $this->product_id = $product->id;
            $this->category_id = $product->category_id;
            $this->brand_id = $product->brand_id;
            $this->name = $product->name;
            $this->oldThumbnail = $product->thumbnail;
            $this->description = $product->description;
            $this->meta_description = $product->meta_description;
            $this->keywords = explode(',', $product->meta_keywords);
        } else {
            session()->flash('error', 'Product not found.');
            return $this->redirectRoute('admin.products.list', navigate: true);
        }
    }

    public function addKeyword()
    {
        $this->keyword = trim($this->keyword);
        if ($this->keyword) {
            if (!in_array($this->keyword, $this->keywords)) {
                $this->keywords[] = $this->keyword;
            } else {
                session()->flash('error', 'The keyword "' . $this->keyword . '"  already exists in the list.');
            }
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
        $this->reset(['category_id', 'brand_id', 'name', 'thumbnail', 'description', 'keyword', 'meta_keywords', 'meta_description']);
        return $this->redirectRoute('admin.products.list', navigate: true);
    }

    public function update($product_id)
    {
        $this->meta_keywords = !empty($this->keywords) ? implode(', ', $this->keywords) : NULL;
        $this->validate([
            'category_id' => ['required', 'integer', 'min:1'],
            'brand_id' => ['required', 'integer', 'min:1'],
            'name' => ['required', 'string', 'max:24', 'unique:products,name,' . $product_id],
            'description' => ['required', 'string', 'max:500'],
            'meta_keywords' => ['required', 'string', 'max:255'],
            'meta_description' => ['required', 'string', 'max:160'],
        ]);
        $product = Product::find($product_id);
        if ($product) {
            $product->category_id = $this->category_id;
            $product->brand_id = $this->brand_id;
            $product->name = trim($this->name);
            if ($this->thumbnail) {
                $this->validate([
                    'thumbnail' => [
                        'required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:512',
                        // 'dimensions:min_width=440,min_height=248,max_width=1280,max_height=720'
                    ]
                ], [
                    'thumbnail.dimensions' => 'The thumbnail must have dimensions between 440x248 and 1280x720 with a 16:9 aspect ratio.',
                ]);
                Storage::disk('public')->delete($this->oldThumbnail);
                $product->thumbnail =  $this->thumbnail->store('uploads/products', 'public');
            }
            $product->description = $this->description;
            $product->slug = str_replace(' ', '-', trim($this->name));
            $product->meta_keywords = $this->meta_keywords;
            $product->meta_description = $this->meta_description;
            $product->update();
            session()->flash('success', 'Product information updated successfully.');
            $this->cancel();
            return $this->redirectRoute('admin.products.list', navigate: true);
        } else {
            $this->cancel();
            session()->flash('error', 'Product information not found.');
            return $this->redirectRoute('admin.products.list', navigate: true);
        }
    }

    public function render()
    {
        if (!empty($this->category_id)) {
            $this->brands = Brand::where('status', 'published')->where('category_id', $this->category_id)->get();
        } else {
            $this->brands = [];
        }

        return view('livewire.panel.admin.product-management.products.edit', [
            'categories' => Category::where('status', 'published')->select('id', 'title')->get(),
            'brands' => $this->brands
        ]);
    }
}