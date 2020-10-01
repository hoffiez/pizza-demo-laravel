<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Utils\CurrencyConverter;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'currency' => 'in:USD,EUR'
        ]);

        $products = Product::all();

        $products->transform(function($item) use ($request){
           $item['price'] = CurrencyConverter::convert($item['price'], $request->input('currency'));
           return $item;
        });

        return response()->json($products);
    }
}
