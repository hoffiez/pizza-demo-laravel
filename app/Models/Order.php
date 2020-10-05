<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *  title="Order",
 *  @OA\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @OA\Property(
 *      property="user_id",
 *      type="integer"
 *  ),
 *  @OA\Property(
 *      property="email",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="tax",
 *      type="number"
 *  ),
 *  @OA\Property(
 *      property="subtotal",
 *      type="number"
 *  ),
 *  @OA\Property(
 *      property="sum_total",
 *      type="number"
 *  ),
 *  @OA\Property(
 *      property="payment_method",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="delivery_price",
 *      type="number"
 *  ),
 *  @OA\Property(
 *      property="name",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="recipient_country",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="recipient_state",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="recipient_city",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="recipient_address",
 *      type="string"
 *  )
 * )
 */
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
