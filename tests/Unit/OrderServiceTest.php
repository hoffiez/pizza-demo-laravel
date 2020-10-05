<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @dataProvider productsDataProvider
     * @param $products
     * @param $expected
     */
    public function testCalculateCart($products, $expected)
    {
        /** @var OrderService $orderService */
        $orderService = app(OrderService::class);

        $cartProducts = [];

        foreach ($products as $product) {
            $newProduct = Product::factory()->create([
                'quantity' => 100,
                'price' => $product['price']
            ]);
            $cartProducts[] = [
                'id' => $newProduct->id,
                'quantity' => $product['quantity']
            ];
        }

        $result = $orderService->calculateCart($cartProducts, 'USD', 19, 1);

        $this->assertSame($result['subtotal'], $expected['subtotal']);
        $this->assertSame($result['tax'], $expected['tax']);
        $this->assertSame($result['sum_total'], $expected['sum_total']);
    }


    public function productsDataProvider()
    {
        return [
            [
                [
                    [
                        'price' => 100.40,
                        'quantity' => 20
                    ],
                    [
                        'price' => 100.4999,
                        'quantity' => 40
                    ],
                    [
                        'price' => 4020.155,
                        'quantity' => 11
                    ],
                    [
                        'price' => 123.45,
                        'quantity' => 23
                    ]
                ],
                [
                    'subtotal' => 53089.11,
                    'tax' => 10086.93,
                    'sum_total' => 63177.04
                ]
            ]
        ];
    }



}
