<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use http\Exception\UnexpectedValueException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    /**
     * Creates order for the specified user
     * @param Request $request
     * @param User $user
     * @return Order
     */
    public function createOrder(Request $request, User $user = null)
    {
        $calculatedData = $this->calculateCart($request, $request->input('currency'));

        $order = DB::transaction(function() use (
            $request,
            $calculatedData,
            $user
        ) {
            $inputData = $request->only([
                'name',
                'email',
                'recipient_country',
                'recipient_state',
                'recipient_city',
                'recipient_address',
                'payment_method',
                'currency'
            ]);

            if ($user) {
                $inputData['user_id'] = $user->id;
            }

            /** @var Order $order */
            $order = Order::create(array_merge(
                $inputData,
                [
                    'subtotal' => $calculatedData['subtotal'],
                    'tax' => $calculatedData['tax'],
                    'delivery_price' => $calculatedData['delivery_price'],
                    'sum_total' => $calculatedData['sum_total']
                ]
            ));

            $order->products()->attach($this->prepareProductsForSave($calculatedData['products']));

            return $order;
        });

        return $order;
    }

    /**
     * @param Request $request
     * @param $currency
     * @return array
     */
    public function calculateCart(Request $request, $currency)
    {
        $products = $this->calculateProducts($request->input('products'), $currency);
        $subTotal = $this->getSubTotal($products);
        $taxPercentage = 19; //percentage
        $taxValue = $subTotal * $taxPercentage / 100;
        $deliveryPrice = 1; //in dollars
        $sumTotal = $deliveryPrice + $subTotal + $taxValue;

        return [
            'products' => $products,
            'subtotal' => $this->round($subTotal),
            'tax' => $this->round($taxValue),
            'delivery_price' => $deliveryPrice,
            'sum_total' => $this->round($sumTotal)
        ];
    }

    /**
     * @param $selectedProducts
     */
    public function validateQuantity($selectedProducts)
    {
        $products = Product::whereIn('id', Arr::pluck($selectedProducts, 'id'))->get()->keyBy('id');

        $productsToAdd = [];
        $subTotal = 0;

        foreach ($selectedProducts as $selectedProduct) {
            $product = $products[$selectedProduct['id']];
            $quantityAvailable = $product->quantity;

            if ($selectedProduct['quantity'] > $quantityAvailable) {
                throw new UnexpectedValueException("The requested quantity is not available"); //TODO:
            }

            $productsToAdd[$product['id']] = [
                'buy_price' => $product->price,
                'quantity' => $selectedProduct['quantity']
            ];

            $subTotal += $product->price * $selectedProduct['quantity'];
        }
    }

    /**
     * Prepares products array for inserting into DB
     * @param Collection $products
     * @return Collection
     */
    private function prepareProductsForSave(Collection $products)
    {
        return $products->keyBy('id')->map(function($item) {
            return $item->only(['buy_price', 'subtotal', 'quantity']);
        });
    }

    /**
     * @param $selectedProducts
     * @param $currency
     * @return Collection|\Illuminate\Support\Collection
     */
    private function calculateProducts($selectedProducts, $currency)
    {
        $selectedProducts = collect($selectedProducts);
        /** @var Collection $products */
        $products = Product::whereIn('id', $selectedProducts->pluck('id'))->get();
        $selectedProducts = $selectedProducts->keyBy('id');

        $results = $products->map(function(Product $item) use ($selectedProducts, $currency) {
            $selectedQuantity = $selectedProducts[$item->id]['quantity'];
            $buyPrice = $this->round($item->getPrice($currency));

            return [
                'id' => $item->id,
                'buy_price' => $buyPrice,
                'price' => $buyPrice,
                'subtotal' => $this->round($buyPrice * $selectedQuantity),
                'quantity' => $selectedQuantity,
                'title' =>  $selectedProducts[$item->id]['title'],
                'img_url' => $selectedProducts[$item->id]['img_url'],
                'currency' => $currency
            ];
        });

        return $results;
    }

    /**
     * @param $products
     * @return mixed
     */
    private function getSubTotal($products)
    {
        return collect($products)->sum('subtotal');
    }

    private function round($sum)
    {
        //The rounding method should be chosen according to the business logic
        //Perhaps better to use ceil()
        return round($sum, 2);
    }
}