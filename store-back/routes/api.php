<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/products',[ProductController::class, 'index']);
Route::post('/products/store',[ProductController::class, 'store']);
Route::get('/products/{id}/show',[ProductController::class, 'show']);
Route::put('/products/{id}/update',[ProductController::class, 'update']);
Route::delete('/products/{id}/destroy',[ProductController::class, 'destroy']);

Route::get('/categories',[CategoryController::class, 'index']);
Route::post('/categories/store',[CategoryController::class, 'store']);
Route::get('/categories/{id}/show',[CategoryController::class, 'show']);
Route::put('/categories/{id}/update',[CategoryController::class, 'update']);
Route::delete('/categories/{id}/destroy',[CategoryController::class, 'destroy']);