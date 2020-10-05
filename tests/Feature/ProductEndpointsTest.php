<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProductEndpointsTest extends TestCase
{
    use DatabaseMigrations;

    public function testGetProducts()
    {
        Product::factory(10)->create([
            'quantity' => 10
        ]);

        $response = $this->getJson('/api/products');
        $response->assertStatus(200);
        $response->assertJsonStructure(['*' => ['id', 'title', 'price']]);
    }
}
