<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Order
 *
 * @OA\Schema (
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
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property string $subtotal
 * @property string $tax
 * @property string $delivery_price
 * @property string $sum_total
 * @property string $name
 * @property string $email
 * @property string $recipient_country
 * @property string $recipient_state
 * @property string $recipient_city
 * @property string $recipient_address
 * @property string $currency
 * @property string $payment_method
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRecipientAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRecipientCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRecipientCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRecipientState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSumTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
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
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $title
 * @property string|null $description
 * @property string $price
 * @property int $quantity
 * @property string|null $product_image_url
 * @property-read mixed $img_url
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @OA\Schema (
 *  title="User",
 *  @OA\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @OA\Property(
 *      property="email",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="name",
 *      type="string"
 *  )
 * )
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperUser extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

