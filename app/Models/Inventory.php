<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Don't forget to import SoftDeletes
use App\Models\Product;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'product_id',
        'stock'
    ];

    public function product() // Method name should be 'belongsTo' instead of 'BelongsTo'
    {
        return $this->belongsTo(Product::class); // Corrected method name
    }
}
