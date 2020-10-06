<?php

namespace App\Models;

use App\Utils\CurrencyConverter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema (
 *  title="Product",
 *  @OA\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @OA\Property(
 *      property="title",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="description",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="price",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="img_url",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="currency",
 *      type="string"
 *  )
 * )
 * @mixin IdeHelperProduct
 */
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

    public function getConvertedPrice($currency = 'USD')
    {
        return CurrencyConverter::convert($this->price, $currency);
    }
}
