<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Brands;

use App\Models\Brand;
use App\Models\Category;
use App\Models\UserAction;
use Illuminate\Support\Facades\Auth;
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
        $this->reset(['category_id','brand_id', 'name', 'thumbnail', 'description', 'keyword', 'meta_keywords', 'meta_description']);
        return $this->redirectRoute('admin.brands.list', navigate: true);
    }

    public function update(Brand $brand)
    {
        if (!empty($brand)) {
            if (empty($this->keywords)) {
                $this->addKeyword();
            } else {
                $this->meta_keywords = !empty($this->keywords) ? implode(', ', $this->keywords) : NULL;
                $this->validate([
                    'category_id' => ['required', 'integer', 'min:1', 'exists:categories,id'],
                    'name' => ['required', 'string', 'max:48', 'unique:brands,name,' . $brand->id],
                    'description' => ['required', 'string', 'max:500'],
                    'meta_keywords' => ['required', 'string', 'max:255'],
                    'meta_description' => ['required', 'string', 'max:160'],
                ]);
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
                    $brand->thumbnail =  $this->thumbnail->store('uploads/brands', 'public');
                }
                $brand->update([
                    'author_id' => Auth::id(),
                    'category_id' => $this->category_id,
                    'name' => trim($this->name),
                    'description' => strip_tags($this->description),
                    'slug' => str_replace(' ', '-', trim($this->name)),
                    'meta_keywords' => $this->meta_keywords,
                    'meta_description' => strip_tags($this->meta_description),
                ]);
                UserAction::create([
                    'user_id' => Auth::id(),
                    'action' => 'brand',
                    'action_id' => $brand->id,
                    'type' => 'update',
                    'ip' => request()->ip(),
                    'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
                ]);
                session()->flash('success', 'Brand updated successfully.');
                $this->cancel();
            }
        } else {
            session()->flash('error', 'Brand not found.');
            $this->cancel();
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.brands.edit');
    }
}