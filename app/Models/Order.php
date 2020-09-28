<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tax',
        'subtotal',
        'delivery_price',
        'sum_total',
        'name',
        'email',
        'recipient_country',
        'recipient_state',
        'recipient_city',
        'recipient_address',
        'payment_method',
        'currency'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['buy_price', 'quantity', 'subtotal']);
    }
}
