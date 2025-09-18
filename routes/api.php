<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ClientController;

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

// Public authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/revoke-all-tokens', [AuthController::class, 'revokeAllTokens']);
    
    // User routes
    Route::apiResource('users', UserController::class);
    Route::get('/users/search/query', [UserController::class, 'search']);
    
    // Product routes
    Route::apiResource('products', ProductController::class);
    Route::get('/products/search/query', [ProductController::class, 'search']);
    Route::get('/products/stock/low', [ProductController::class, 'lowStock']);
    Route::get('/products/category/filter', [ProductController::class, 'byCategory']);
    Route::patch('/products/{product}/stock', [ProductController::class, 'updateStock']);
    
    // Client routes
    Route::apiResource('clients', ClientController::class);
    Route::get('/clients/search/query', [ClientController::class, 'search']);
    Route::get('/clients/region/filter', [ClientController::class, 'byRegion']);
    Route::get('/clients/city/filter', [ClientController::class, 'byCity']);
    Route::get('/clients/stats/overview', [ClientController::class, 'statistics']);
});