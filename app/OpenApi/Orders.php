<?php

/**
 * @OA\Post(
 *     path="/orders",
 *     summary="Create order",
 *     tags={"Orders"},
 *     @OA\Parameter(
 *         name="products",
 *         in="query",
 *         required=true,
 *         @OA\Schema(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/ProductInCart")
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="email",
 *         in="query",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="recipient_country",
 *         in="query",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *      @OA\Parameter(
 *         name="recipient_state",
 *         in="query",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="recipient_city",
 *         in="query",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="recipient_address",
 *         in="query",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="payment_method",
 *         in="query",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="currency",
 *         in="query",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             enum={"USD", "EUR"}
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/Order")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="invalid input",
 *     )
 * )
 *
 */

/**
 * @OA\Get(
 *     path="/orders",
 *     summary="Get list of user orders",
 *     tags={"Orders"},
 *     @OA\Response(
 *         response=200,
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Order")
 *         ),
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="user unauthorized"
 *     )
 * )
 */

/**
 * @OA\Post(
 *     path="/calculateCart",
 *     summary="Calculate cart",
 *     tags={"Orders"},
 *     @OA\Parameter(
 *         name="products",
 *         in="query",
 *         required=true,
 *         @OA\Schema(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/ProductInCart")
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                  property="products",
 *                  ref="#/components/schemas/CartProductCalculated"
 *             ),
 *              @OA\Property(
 *                  property="delivery_price",
 *                  type="number"
 *              ),
 *              @OA\Property(
 *                  property="subtotal",
 *                  type="number",
 *              ),
 *              @OA\Property(
 *                  property="tax",
 *                  type="number"
 *              ),
 *              @OA\Property(
 *                  property="sum_total",
 *                  type="number",
 *              )
 *         ),
 *     ),
 * )
 *
 */