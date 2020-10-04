<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\OrderService;
use App\Services\UserService;
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
     * @param UserService $userService
     * @return JsonResponse
     */
    public function store(Request $request, OrderService $orderService, UserService $userService)
    {
        $request->validate([
            'products' => 'required', //minimum one product is required
            'products.*.id' => 'required',
            'products.*.quantity' => 'required|min:1|max:100', //max value depends on business logic
            'name' => 'required',
            'email' => 'required',
            'recipient_country' => 'required',
            'recipient_state' => 'required',
            'recipient_city' => 'required',
            'recipient_address' => 'required',
            'payment_method' => 'required|in:cash_delivery,card_online',
            'currency' => 'required|in:USD,EUR'
        ]);

        /** @var User $user */
        $user = $this->guard()->user();

        if ($user === null && $request->input('signup')) {
            $user = $userService->signUpUser($request);
            $token = $userService->loginUser($user, $this->guard());
            $tokenPayload = $userService->getTokenPayload($token, $this->guard());
        }

        $order = $orderService->createOrder($request, $user);

        if (isset($tokenPayload)) {
            $order['token'] = $tokenPayload;
        }

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
            'products.*.quantity' => 'required|min:1|max:100',
            'currency' => 'required|in:USD,EUR' //TODO: custom validator
        ]);

        $response = $orderService->calculateCart($request, $request->input('currency'));

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
