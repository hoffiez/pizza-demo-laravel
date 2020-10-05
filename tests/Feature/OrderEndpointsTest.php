<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use DatabaseMigrations;

    private $cartProducts;

    public function setUp(): void
    {
        parent::setUp();

        Product::factory(10)->create([
            'quantity' => 100
        ]);

        $this->cartProducts = Product::limit(20)->get()->map(function(Product $item) {
            return [
                'id' => $item->id,
                'quantity' => rand(1, 100)
            ];
        });
    }

    /**
     * @dataProvider orderDataProvider
     */
    public function testCreateSuccessWithoutSignUp($data)
    {
        $response = $this->postJson('/api/orders',array_merge($data, [
            "products" => $this->cartProducts
        ]));

        $response->dump();
        $response->assertStatus(201);
    }

    /**
     * @dataProvider orderDataProvider
     */
    public function testCreateSuccessAuthorized($data)
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/orders', array_merge($data, [
            "products" => $this->cartProducts
        ]));

        $response->dump();

        $response->assertStatus(201);
        $response->assertJson([
            'user_id' => $user->id
        ]);
    }

    /**
     * @dataProvider orderDataProvider
     */
    public function testCreateSuccessWithSignUp($data)
    {
        $response = $this->postJson('/api/orders', array_merge($data, [
            "products" => $this->cartProducts,
            "password" => '12345678',
            "password_confirmation" => '12345678',
            "pd_agreement" => true,
            "signup" => true
        ]));

        $response->dump();
        $response->assertStatus(201);
        $response->assertJsonStructure(['token']);
    }

    public function testGetUserOrders()
    {
        $response = $this->getJson('/api/orders');
        $response->assertStatus(401);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson('/api/orders');
        $response->assertStatus(200);
    }

    public function testCalculateCart()
    {
        $response = $this->postJson('/api/calculateCart', [
            'products' => $this->cartProducts,
            'currency' => 'EUR'
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['sum_total', 'subtotal', 'tax']);
        //TODO: assert
    }

    public function orderDataProvider()
    {
        return [
            [
                [
                    "name" => "Test Name",
                    "email" => "testemail@example.com",
                    "recipient_country" => "USA",
                    "recipient_city" => "Los Angeles",
                    "recipient_state" => "CA",
                    "recipient_address" => "Los Angeles",
                    "payment_method" => "cash_delivery",
                    "currency" => 'EUR'
                ]
            ]
        ];
    }
}
