<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'title' => 'Carbonara',
                'product_image_url' => '1e414bf6663645f592d166329e1fec83_292x292.jpeg'
            ],
            [
                'title' => 'Pesto',
                'product_image_url' => '548f06002e5d46c699245285d5f4b1cc_292x292.jpeg'
            ],
            [
                'title' => 'Pepperoni Fresh with tomatoes',
                'product_image_url' => 'f57b939a4455453daade38016f61d766_292x292.jpeg'
            ],
            [
                'title' => 'Pepperoni Fresh with pepper',
                'product_image_url' => 'f035c7f46c0844069722f2bb3ee9f113_292x292.jpeg'
            ],
            [
                'title' => 'Cheese',
                'product_image_url' => 'c2da53ec-00e2-4446-a4e6-74b83ed0b357.jpg'
            ],
            [
                'title' => 'Ham and cheese',
                'product_image_url' => 'dd59dcd5-cbf7-44e9-a5bd-1654ef06e6a3.jpg'
            ],
            [
                'title' => 'Ham and mushrooms',
                'product_image_url' => 'b1ffa66f2ebb4e959122e54eaa071109_292x292.jpeg'
            ],
            [
                'title' => 'Cheeseburger pizza',
                'product_image_url' => '1959b0fdf5f049fb9ec12cf05d535bc7_292x292.jpeg'
            ],
            [
                'title' => 'Cheese chicken',
                'product_image_url' => 'a89a7652-0f1f-4286-b41b-ef4c14c98331.jpg'
            ]
        ];

        foreach ($products as $product){
            Product::factory()->create([
                'title' => $product['title'],
                'product_image_url' => Storage::url("pizzas/{$product['product_image_url']}")
            ]);
        }

    }
}
