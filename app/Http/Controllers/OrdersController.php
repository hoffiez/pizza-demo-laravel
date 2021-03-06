<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Currency;
use App\Rules\ProductQuantity;
use App\Services\OrderService;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return response()->json($user->orders()->with('products')->orderByDesc('id')->limit(20)->get());
    }

    /**
     * @param Request $request
     * @param OrderService $orderService
     * @return JsonResponse
     */
    public function store(Request $request, OrderService $orderService)
    {
        $request->validate([
            'products' => 'required', //minimum one product is required
            'products.*.id' => 'required',
            'products.*.quantity' => ['required', new ProductQuantity],
            'name' => 'required',
            'email' => 'required',
            'recipient_country' => 'required',
            'recipient_state' => 'required',
            'recipient_city' => 'required',
            'recipient_address' => 'required',
            'payment_method' => 'required|in:cash_delivery,card_online',
            'currency' => ['required', new Currency]
        ]);

        /** @var User $user */
        $user = $this->guard()->user();
        $order = $orderService->createOrder($request, $user);

        return response()->json($order, 201);
    }

    /**
     * @param Request $request
     * @param OrderService $orderService
     * @return JsonResponse
     */
    public function calculateCart(Request $request, OrderService $orderService)
    {
        $request->validate([
            'products' => 'required',
            'products.*.id' => 'required',
            'products.*.quantity' => ['required', new ProductQuantity],
            'currency' => ['required', new Currency]
        ]);

        $response = $orderService->calculateCart($request->input('products'), $request->input('currency'));
        return response()->json($response, 200);
    }

    /**
     * @return Guard
     */
    protected function guard() : Guard
    {
        return Auth::guard('api');
    }
}
