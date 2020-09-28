<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'quantity',
        'product_image_url'
    ];

    protected $appends = ['img_url'];

    public function getImgUrlAttribute()
    {
        if ($this->attributes['product_image_url'] === null) return null;

        return config('app.url') .$this->attributes['product_image_url'];
    }
}
