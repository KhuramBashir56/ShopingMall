<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockUnit extends Model
{
    use HasFactory;

    protected $table = 'stock_units';

    protected $fillable = ['author_id', 'title', 'code', 'description'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}