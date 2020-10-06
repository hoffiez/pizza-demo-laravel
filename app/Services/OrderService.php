<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Utils\CurrencyConverter;;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;

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
        $calculatedData = $this->calculateCart($request->input('products'), $request->input('currency'));

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
     * @param $selectedProducts
     * @param $currency
     * @param int $taxPercentage
     * @param int $deliveryPrice
     * @return array
     */
    public function calculateCart($selectedProducts, $currency, $taxPercentage = 19, $deliveryPrice = 1)
    {
        $products = $this->calculateProducts($selectedProducts, $currency);
        $subTotal = $this->round($this->getSubTotal($products));
        $taxValue = $this->round($subTotal * $taxPercentage / 100);
        $deliveryPrice = $this->round(CurrencyConverter::convert($deliveryPrice, $currency));
        $sumTotal = $this->round($deliveryPrice + $subTotal + $taxValue);

        return [
            'products' => $products,
            'subtotal' => $subTotal,
            'tax' => $taxValue,
            'delivery_price' => $deliveryPrice,
            'sum_total' => $sumTotal
        ];
    }

    /**
     * Prepares products array for inserting into DB
     * @param SupportCollection $products
     * @return SupportCollection
     */
    private function prepareProductsForSave(SupportCollection $products)
    {
        return $products->keyBy('id')->map(function($item) {
            return Arr::only($item, ['buy_price', 'subtotal', 'quantity']);
        });
    }

    /**
     * @param $selectedProducts
     * @param $currency
     * @return Collection|SupportCollection
     */
    private function calculateProducts($selectedProducts, $currency)
    {
        $selectedProducts = collect($selectedProducts);
        /** @var Collection $products */
        $products = Product::whereIn('id', $selectedProducts->pluck('id'))->get();
        $selectedProducts = $selectedProducts->keyBy('id');

        $results = $products->map(function(Product $item) use ($selectedProducts, $currency) {
            $selectedQuantity = $selectedProducts[$item->id]['quantity'];
            $buyPrice = $this->round($item->getConvertedPrice($currency));

            return [
                'id' => $item->id,
                'buy_price' => $buyPrice,
                'price' => $buyPrice,
                'subtotal' => $this->round($buyPrice * $selectedQuantity),
                'quantity' => $selectedQuantity,
                'title' =>  $item->title,
                'img_url' => $item->img_url,
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

    /**
     * @param $sum
     * @return float
     */
    private function round($sum)
    {
        //The rounding method should be chosen according to the business logic
        //Perhaps better to use ceil()
        return round($sum, 2);
    }
}