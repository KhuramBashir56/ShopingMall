<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['author_id', 'category_id', 'brand_id', 'unit_id', 'name', 'thumbnail', 'description', 'slug', 'meta_keywords', 'meta_description'];

    protected $casts = [
        'deleted_at' => 'datetime'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(ProductUnit::class, 'unit_id', 'id');
    }
}
