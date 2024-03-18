<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUnit extends Model
{
    use HasFactory;

    protected $table = 'product_units';

    protected $fillable = ['author_id', 'title', 'code', 'description'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}