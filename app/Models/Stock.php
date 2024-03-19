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

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    
    public function price()
    {
        return $this->hasOne(Price::class, 'stock_id', 'id')->withDefault(['purchase' => 0, 'wholesale' => 0, 'retail' => 0]);
    }

}