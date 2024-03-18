<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    protected $fillable = ['product_id', 'supplier_name', 'supplied_at', 'invoice_Id', 'quantity', 'expiry_date', 'author_id', 'remarks'];

    protected $casts = [
        'supplied_at' => 'datetime',
        'verified_at' => 'datetime',
        'expiry_date' => 'datetime'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}