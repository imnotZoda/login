<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use App\Models\Product;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'product_id',
        'stock'
    ];

    public function product() 
    {
        return $this->belongsTo(Product::class);
    }
}
