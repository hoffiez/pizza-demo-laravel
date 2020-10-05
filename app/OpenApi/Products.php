<?php

/**
 * @OA\Get(
 *     path="/products",
 *     summary="Get list of products",
 *     tags={"Products"},
 *      @OA\Parameter(
 *         name="currency",
 *         in="query",
 *         description="Available currency: USD or EUR",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             default="USD",
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Product")
 *         ),
 *     )
 * )
 */