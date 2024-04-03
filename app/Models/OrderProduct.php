<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'qty',
        'orderlist_id',
        'product_id'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
 

}
