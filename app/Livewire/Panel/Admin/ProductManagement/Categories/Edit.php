<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Categories;

use App\Models\Category;
use App\Models\UserAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $category_id, $title, $thumbnail, $oldThumbnail, $description, $keyword, $meta_keywords, $meta_description = '';

    public $keywords = [];

    public function mount($category_id)
    {
        $category = Category::find($category_id);
        if (empty($category)) {
            session()->flash('error', 'Category not found.');
            return $this->redirectRoute('admin.categories.list', navigate: true);
        } else {
            $this->category_id = $category->id;
            $this->title = $category->title;
            $this->oldThumbnail = $category->thumbnail;
            $this->description = $category->description;
            $this->keywords = explode(',', $category->meta_keywords);
            $this->meta_description = $category->meta_description;
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
        $this->reset(['title', 'thumbnail', 'description', 'keyword', 'meta_keywords', 'meta_description']);
        return $this->redirectRoute('admin.categories.list', navigate: true);
    }

    public function update(Category $category)
    {
        if (!empty($category)) {
            if (empty($this->keywords)) {
                $this->addKeyword();
            } else {
                $this->meta_keywords = !empty($this->keywords) ? implode(', ', $this->keywords) : NULL;
                $this->validate([
                    'title' => ['required', 'string', 'max:48', 'unique:categories,title,' . $category->id],
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
                    $category->thumbnail =  $this->thumbnail->store('uploads/categories', 'public');
                }
                $category->update([
                    'author_id' => Auth::user()->id,
                    'title' => trim($this->title),
                    'description' => strip_tags($this->description),
                    'slug' => str_replace(' ', '-', trim($this->title)),
                    'meta_keywords' => $this->meta_keywords,
                    'meta_description' => strip_tags($this->meta_description),
                ]);
                UserAction::create([
                    'user_id' => Auth::id(),
                    'action' => 'product_category',
                    'action_id' => $category->id,
                    'type' => 'update',
                    'ip' => request()->ip(),
                    'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
                ]);
                session()->flash('success', 'Data saved category updated successfully.');
                $this->cancel();
            }
        } else {
            session()->flash('error', 'Category not found.');
            $this->cancel();
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.categories.edit');
    }
}
