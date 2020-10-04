<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Rules\Currency;
use App\Utils\CurrencyConverter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $request->validate([
            'currency' => new Currency
        ]);

        $products = Product::all();

        $products->transform(function($item) use ($request){
           $item['price'] = CurrencyConverter::convert($item['price'], $request->input('currency'));
           return $item;
        });

        return response()->json($products);
    }
}
