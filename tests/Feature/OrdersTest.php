<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        Product::factory(10)->create([
            'quantity' => 100
        ]);
    }

    /**
     *
     *
     * @return void
     */
    public function testCreateSuccess()
    {
        $products = Product::limit(20)->get()->map(function(Product $item) {
            return [
                'id' => $item->id,
                'quantity' => rand(1, 100)
            ];
        });

        $response = $this->post('/api/orders', [
            "recipient_name" => "Test Name",
            "recipient_email" => "testemail@example.com",
            "recipient_country" => "USA",
            "recipient_city" => "Los Angeles",
            "recipient_state" => "CA",
            "recipient_address" => "Los Angeles",
            "payment_method" => "cash_delivery",
            "products" => $products,
            "currency" => 'EUR'
        ]);

        $response->assertStatus(201);
    }

    public function testCreateFailedTooMuchQuantity()
    {
        $response = $this->post('/api/orders', [
            "recipient_name" => "Test Name",
            "recipient_email" => "testemail@example.com",
            "recipient_country" => "USA",
            "recipient_city" => "Los Angeles",
            "recipient_state" => "CA",
            "recipient_address" => "Los Angeles",
            "payment_method" => "cash_delivery",
            "products" => [
                [
                    "id" => 1,
                    "quantity" => 1000
                ],
                [
                    "id" => 2,
                    "quantity" => 10
                ]
            ]
        ]);

        //TODO: assert exception
        $response->assertStatus(500);
    }
}
