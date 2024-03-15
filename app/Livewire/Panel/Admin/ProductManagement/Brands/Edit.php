<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Brands;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    use WithFileUploads;

    public $brand_id, $name, $categories, $category_id, $thumbnail, $oldThumbnail, $description, $keyword, $meta_keywords, $meta_description;

    public $keywords = [];

    public function mount($brand_id)
    {
        $brand = Brand::find($brand_id);
        if (!$brand) {
            session()->flash('error', 'Brand not found.');
            return $this->redirectRoute('admin.brands.list', navigate: true);
        } else {
            $this->categories = Category::select('id', 'title')->where('status', 'published')->get();
            $this->brand_id = $brand->id;
            $this->category_id = $brand->category_id;
            $this->name = $brand->name;
            $this->oldThumbnail = $brand->thumbnail;
            $this->description = $brand->description;
            $this->keywords = explode(',', $brand->meta_keywords);
            $this->meta_description = $brand->meta_description;
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
        $this->reset(['category', 'name', 'thumbnail', 'description', 'keyword', 'meta_keywords', 'meta_description']);
        return $this->redirectRoute('admin.brands.list', navigate: true);
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.brands.edit');
    }
}