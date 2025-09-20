<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;
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
Route::get('/showuser', [LoginController::class, 'apiUser']);

Route::post('/register', [ RegisterController::class, 'apiRegister']);
Route::post('/logout', [LoginController::class, 'apiLogout'])->middleware('auth:sanctum');

///////////////////////////////category
use App\Http\Controllers\CategoryController;

Route::post('/categories', [CategoryController::class, 'apiAddCategory']);
Route::get('/categories', [CategoryController::class, 'apiShowCategories']);
Route::post('/checkout', [OrderController::class, 'checkout1']);
Route::post('/checkout', [OrderController::class, 'checkoutFromApi']);



Route::get('/sliders', [HomeController::class, 'index1']);
//Route::post('/sliders', [HomeController::class, 'store']);
use App\Http\Controllers\Offerscontroller;

Route::post('/offers/add', [Offerscontroller::class, 'apiAddOffer']);

 Route::middleware('auth:sanctum')->get('/flutter-notifications', [OrderController::class, 'getFlutterNotifications']);
use App\Models\FlutterNotification;


// Route::get('/flutter-notifications', function (Request $request) {
//     $userId = $request->query('user_id');
//     $data = FlutterNotification::where('user_id', $userId)->latest()->get();

//     return response()->json([
//         'status' => true,
//         'data' => $data
//     ]);
// });

// Route::get('/flutter-notifications', function (Request $request) {
//     $userId = $request->query('user_id');

//     $data = FlutterNotification::where('user_id', $userId)
//                 ->orderBy('created_at', 'desc')
//                 ->get();

//     return response()->json([
//         'status' => true,
//         'data' => $data
//     ]);
// });
use App\Models\Order;

// Route::get('/orders', function (Request $request) {
//     $userId = $request->query('user_id');

//     $orders = Order::where('user_id', $userId)
//         ->where('order_status', 'confirmed')
//         ->latest()
//         ->get(['id', 'order_status', 'created_at']);

//     $notifications = $orders->map(function ($order) {
//         return [
//             'title' => 'Order Confirmed ✅',
//             'message' => "Your order #{$order->id} has been confirmed.",
//             'timestamp' => $order->created_at->toDateTimeString()
//         ];
//     });

//     return response()->json([
//         'status' => true,
//         'notifications' => $notifications
//     ]);
// });
// // Route::middleware('auth:sanctum')->get('/flutter-notifications', [OrderController::class, 'getFlutterNotifications']);
//  use App\Http\Controllers\NotificationController;

// // Route::get('/flutter-notifications', [NotificationController::class, 'getFlutterNotifications']);
// Route::get('/flutter-notifications', [NotificationController::class, 'index']);



// Keep other unrelated routes (e.g., orders API)
Route::get('/orders', function (Request $request) {
    $userId = $request->query('user_id');

    $orders = Order::where('user_id', $userId)
        ->where('order_status', 'confirmed')
        ->latest()
        ->get(['id', 'order_status', 'created_at']);

    $notifications = $orders->map(function ($order) {
        return [
            'title' => 'Order Confirmed ✅',
            'message' => "Your order #{$order->id} has been confirmed.",
            'timestamp' => $order->created_at->toDateTimeString()
        ];
    });

    return response()->json([
        'status' => true,
        'notifications' => $notifications
    ]);
});



// websocket
Route::get('/websocket', [MessageController::class, 'sendToAll']);
Route::post('/websocket', [MessageController::class, 'sendToAll']);
//Route::post('/websocket1', [OrderController::class, 'confirmOrder']);






Route::get('/user-notifications', [OrderController::class, 'getUserNotifications']);
Route::post('/orders/{id}/approve', [OrderController::class, 'approveOrder']);
use App\Http\Controllers\OneSignalController;

Route::middleware('auth:sanctum')->post('/store-player-id', [OneSignalController::class, 'storePlayerId']);
