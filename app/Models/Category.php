<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['author_id', 'title', 'thumbnail', 'description', 'slug', 'meta_keywords', 'meta_description', 'ip', 'device'];

    protected $casts = [
        'deleted_at' => 'datetime'
    ];
}