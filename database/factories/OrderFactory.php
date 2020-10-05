<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subTotal = $this->faker->randomFloat(0, 100);
        $vat = $this->faker->randomFloat(0, 20);
        $deliveryPrice = $this->faker->randomFloat(0, 100);
        $sumTotal = $subTotal + $vat + $deliveryPrice;

        return [
            'subtotal' => $subTotal,
            'vat' => $vat,
            'delivery_price' => $deliveryPrice,
            'sum_total' => $sumTotal,
            'recipient_name' => $this->faker->name,
            'recipient_email' => $this->faker->email,
            'recipient_country' => $this->faker->country,
            'recipient_state' => $this->faker->state,
            'recipient_city' => $this->faker->city,
            'recipient_address' => $this->faker->address,
            'payment_method' => $this->faker->randomElement(['cash_delivery', 'card_online'])
        ];
    }
}
