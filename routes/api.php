<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login',    [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function(){

    Route::get('check-login',      [AuthController::class, 'checkLogin']);
    Route::apiResource('products', ProductController::class);
    Route::post('product-update/{id}', [ProductController::class, 'update']);
    Route::get('attribute-objects', [ProductController::class, 'attributeObject']);
});