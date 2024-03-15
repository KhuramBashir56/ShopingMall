<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = ['author_id', 'category_id', 'name', 'thumbnail', 'description', 'slug', 'meta_keywords', 'meta_description', 'ip', 'device'];

    protected $casts = [
        'deleted_at' => 'datetime'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}