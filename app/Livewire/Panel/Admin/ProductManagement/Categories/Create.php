<?php

namespace App\Livewire\Panel\Admin\ProductManagement\Categories;

use App\Models\Category;
use App\Models\UserAction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    use WithFileUploads;

    public $title, $thumbnail, $description, $keyword, $meta_keywords, $meta_description = '';

    public $keywords = [];

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
        $this->reset(['title', 'thumbnail', 'description', 'keywords', 'meta_keywords', 'meta_description']);
        return $this->redirectRoute('admin.categories.list', navigate: true);
    }

    public function store()
    {
        if (empty($this->keywords)) {
            $this->addKeyword();
        } else {
            $this->meta_keywords = !empty($this->keywords) ? implode(', ', $this->keywords) : NULL;
            $this->validate([
                'title' => ['required', 'string', 'max:48', 'unique:categories,title'],
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
            $category = Category::create([
                'author_id' => Auth::user()->id,
                'title' => trim($this->title),
                'thumbnail' => $this->thumbnail->store('uploads/categories', 'public'),
                'description' => strip_tags($this->description),
                'slug' => str_replace(' ', '-', trim($this->title)),
                'meta_keywords' => $this->meta_keywords,
                'meta_description' => strip_tags($this->meta_description),
            ]);
            UserAction::create([
                'user_id' => Auth::id(),
                'action' => 'product_category',
                'action_id' => $category->id,
                'type' => 'create',
                'ip' => request()->ip(),
                'device' => str_replace('"', '', request()->header('sec-ch-ua-platform'))
            ]);
            session()->flash('success', 'Data saved new category created successfully.');
            $this->cancel();
        }
    }

    public function render()
    {
        return view('livewire.panel.admin.product-management.categories.create');
    }
}