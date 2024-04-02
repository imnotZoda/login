<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Inventory;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['prod_name', 'prod_desc', 'type', 'price', 'img'];

    /**
     * Get the images for the product.
     */
    public function images()
    {
        return explode(',', $this->img);
    }
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'product_id', 'id'); // Corrected relationship definition
    }
}