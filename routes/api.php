<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
use App\Http\Controllers\productcontroller;

Route::get('/products', [productcontroller::class, 'apiIndex']);
Route::get('/products/{id}', [productcontroller::class, 'apiShow']);
Route::post('/products', [productcontroller::class, 'apiStore']);
Route::put('/products/{id}', [productcontroller::class, 'apiUpdate']);
Route::delete('/products/{id}', [productcontroller::class, 'apiDestroy']);

////////////////////////LoGIN
Route::post('/login', [LoginController::class, 'apiLogin']);
Route::post('/register', [ RegisterController::class, 'apiRegister']);
Route::post('/logout', [LoginController::class, 'apiLogout'])->middleware('auth:sanctum');

///////////////////////////////category
use App\Http\Controllers\CategoryController;

Route::post('/categories', [CategoryController::class, 'apiAddCategory']);
Route::get('/categories', [CategoryController::class, 'apiShowCategories']);
Route::post('/checkout', [OrderController::class, 'checkout1']);
Route::post('/checkout', [OrderController::class, 'checkoutFromApi']);



Route::get('/sliders', [HomeController::class, 'index1']);
Route::post('/sliders', [HomeController::class, 'store']);
