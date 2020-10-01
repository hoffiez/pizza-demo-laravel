<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Utils\CurrencyConverter;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return response()->json($products);
    }
}
