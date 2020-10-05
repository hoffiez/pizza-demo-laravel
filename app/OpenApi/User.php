<?php

/**
 * @OA\Post(
 *     path="/signin",
 *     summary="Sign In User",
 *     tags={"User"},
 *      @OA\Parameter(
 *         name="email",
 *         in="query",
 *         description="User email, used at registration",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *      @OA\Parameter(
 *         name="password",
 *         in="query",
 *         description="User password",
 *         required=true,
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
 *         response=422,
 *         description="invalid input",
 *     )
 * )
 *
 */


/**
 * @OA\Post(
 *     path="/signup",
 *     summary="Sign Up User",
 *     tags={"User"},
 *      @OA\Parameter(
 *         name="email",
 *         in="query",
 *         description="Must be unique",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *      @OA\Parameter(
 *         name="password",
 *         in="query",
 *         description="Password, at least 8 characters",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="password_confirmation",
 *         in="query",
 *         description="",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *      @OA\Parameter(
 *         name="name",
 *         in="query",
 *         description="User name",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *     ),
 *      @OA\Parameter(
 *         name="pd_agreement",
 *         in="query",
 *         description="User agreement with the rules",
 *         required=true,
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
 *         response=422,
 *         description="invalid input",
 *     )
 * )
 *
 */