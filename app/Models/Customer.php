<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'un',
        'contactmo',
        'address',
        'img',
        'user_id', // Include the foreign key in fillable array if needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function carts()
    {
        return $this->hasOne(Cart::class);
    }
    public function orders()
    {
        return $this->hasMany(OrderList::class);
    }
}
