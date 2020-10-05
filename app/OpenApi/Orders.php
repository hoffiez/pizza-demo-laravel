<?php

/**
 * @OA\Post(
 *     path="/orders",
 *     summary="Create order",
 *     tags={"Orders"},
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
 *             type="string"
 *         ),
 *     ),
 *      @OA\Parameter(
 *         name="password",
 *         in="query",
 *         description="Password, at least 8 characters",
 *         required=false,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="password_confirmation",
 *         in="query",
 *         description="",
 *         required=false,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *      @OA\Parameter(
 *         name="name",
 *         in="query",
 *         description="User name",
 *         required=false,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *      @OA\Parameter(
 *         name="pd_agreement",
 *         in="query",
 *         description="User agreement with the rules",
 *         required=false,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                  @OA\Property(
 *                      property="auth_token",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="expires_in",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="token_type",
 *                      type="string"
 *                  )
 *             )
 *         ),
 *     ),
 *     @OA\Response(
 *         response=402,
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