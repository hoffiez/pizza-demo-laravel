<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/signout', [SessionsController::class, 'signout']);
});

Route::get('/products', [ProductsController::class, 'index']);
Route::post('/signin', [SessionsController::class, 'signin']);
Route::post('/signup', [SessionsController::class, 'signup']);
