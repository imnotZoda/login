<?php

// app/Models/Supplier.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'contactno', 'img'];

    /**
     * Get the images for the supplier.
     */
    public function images()
    {
        return explode(',', $this->img);
    }
    public function products()
    {

        return $this->hasMany(ProductSupplier::class,'product_suppliers', 'product_id', 'supplier_id');
    }
}