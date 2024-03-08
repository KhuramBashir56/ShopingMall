<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Brands;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    use WithFileUploads;

    public $keywords = [];

    public $category_id, $name, $thumbnail, $description, $keyword, $meta_keywords, $meta_description;

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
        $this->reset(['category_id', 'name', 'thumbnail', 'description', 'keywords', 'meta_keywords', 'meta_description']);        
        return $this->redirectRoute('admin.brands.list');
    }

    public function store()
    {
        $this->meta_keywords = !empty($this->keywords) ? implode(', ', $this->keywords) : NULL;
        $this->validate([
            'category_id' => ['required', 'integer', 'min:1'],
            'name' => ['required', 'string', 'max:24', 'unique:brands,name'],
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
        Brand::create([
            'author_id' => 1,
            'category_id' => $this->category_id,
            'name' => trim($this->name),
            'thumbnail' => $this->thumbnail->store('uploads/brands', 'public'),
            'description' => strip_tags($this->description),
            'slug' => str_replace(' ', '-', trim($this->name)),
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => strip_tags($this->meta_description),
            'ip' => request()->ip(),
            'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
        ]);
        session()->flash('success', 'Data saved new brand add successfully.');
        $this->cancel();
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.brands.create', [
            'categories' => Category::select('id', 'title')->where('status', 'published')->get(),
        ]);
    }
}