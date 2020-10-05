<?php
namespace App\OpenApi\schemas;

/**
 * @OA\Schema(
 *  title="Calculated product",
 *  @OA\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @OA\Property(
 *      property="quantity",
 *      type="integer"
 *  ),
 *  @OA\Property(
 *      property="currency",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="price",
 *      type="number"
 *   ),
 *  @OA\Property(
 *     property="subtotal",
 *     type="number"
 *  )
 * )
 */
class CartProductCalculated
{

}