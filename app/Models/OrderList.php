<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'status',
        'order_date'
    ];

    
    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}