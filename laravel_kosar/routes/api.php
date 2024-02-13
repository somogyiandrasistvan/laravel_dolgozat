<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProductTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('baskets', [BasketController::class, 'index']);
Route::get('baskets/{user_id}/{item_id}', [BasketController::class, 'show']);
Route::post('baskets', [BasketController::class, 'store']);

Route::get('one_product_type/{type_id}', [ProductTypeController::class, 'oneProductType']);

Route::middleware('auth.basic')->group(function () {
    Route::get('show_one_user_basket', [ProductTypeController::class, 'showOneUserBasket']);
    Route::get('put_item/{item_id}', [BasketController::class, 'putItem']);
});
