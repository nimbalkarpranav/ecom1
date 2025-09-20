<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\MessageController1;
use App\Http\Controllers\Categorycontroller;
use App\Http\Controllers\ChildOrderController;
use App\Http\Controllers\Contactcontroller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\Offerscontroller;
use App\Http\Controllers\productcontroller;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', fn() => view('BackEnd.admin.layout'))
    ->middleware(['auth', 'role:admin']);


Route::get('/about', function () {
    return view('frantEnd.pages.about');
})->middleware('about');

Route::get('/contact', function () {
    return view('frantEnd.pages.contct');
})->middleware('about');

// 👇 Public routes (Login/Register)
Route::view('/', 'frantEnd.pages.login')->middleware('guest');
Route::get('/login', fn() => view('frantEnd.pages.login'))->middleware('guest');
Route::post('/', [LoginController::class, 'login'])->name('login');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

// 👇 Alternate login/register views
Route::get('loging', fn() => view('frantEnd.pages.login'));
Route::post('loging', [logincontroller::class, 'Login']);
Route::get('rg', fn() => view('frantEnd.pages.rg'));


// 👇 Protected Routes (require login or role)
Route::middleware(['auth'])->group(function () {

    Route::get('/about', fn() => view('frantEnd.pages.about'))->middleware('about');
    Route::get('/contact', fn() => view('frantEnd.pages.contct'))->middleware('about:user');

    Route::get('/menu', [ProductController::class, 'showMenu'])->name('menu')->middleware('about');

    Route::get('/home', [ProductController::class, 'showMenu1'])->middleware('role')->name('menu');

    Route::view('/admin', 'BackEnd.admin.layout')->middleware('role');
});


// 👇 Duplicate fallback (optional: useful during development)
// Route::get('/about', fn() => view('frantEnd.pages.about'));
// Route::get('/contact', fn() => view('frantEnd.pages.contct'));
// Route::get('/menu', fn() => view('frantEnd.pages.menu'));
// Route::get('/menu', [ProductController::class, 'showMenu'])->name('menu');


// 👇 Admin dashboard
Route::get('/admin', fn() => view('BackEnd.admin.layout'))->middleware(['auth', 'role:admin']);


// 👇 Contact
Route::post('contact', [Contactcontroller::class, 'ContactADD']);
Route::get('ContactTable', [Contactcontroller::class, 'ShowContact']);


// 👇 Product
Route::get('ProductFormTable', [ProductController::class, 'create']);
Route::post('ProductFormTable', [productcontroller::class, 'ProductAdd']);
Route::get('productTable', [productcontroller::class, 'Showproduct'])->name('product.index');
Route::delete('productTable/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('product/update/{id}', [ProductController::class, 'update'])->name('product.update');


// 👇 Category
Route::get('CategoryAdd', fn() => view('BackEnd.pages.Category.ADDCategory'));
Route::post('CategoryAdd', [Categorycontroller::class, 'ADDCATEGORY']);
Route::get('categoryTable', [Categorycontroller::class, 'ShowProduct'])->name('categories.index');
Route::get('ProductForm', [Categorycontroller::class, 'ShowProductFrom']);
Route::delete('categoryTable/{id}', [Categorycontroller::class, 'destroy'])->name('categories.destroy');
Route::get('categories/{id}/edit', [Categorycontroller::class, 'edit'])->name('categories.edit');
Route::put('categories/{id}', [Categorycontroller::class, 'update'])->name('categories.update');


// 👇 Offers
Route::get('offers', fn() => view('BackEnd.pages.offer.add'));
Route::post('offers', [Offerscontroller::class, 'Offers']);
Route::get('/home', [Offerscontroller::class, 'showOffers'])->middleware('role');

// 👇 Slider
Route::get('slider', fn() => view('BackEnd.pages.Slider.AddSlider'));
Route::post('slider', [HomeController::class, 'Slider']);

// 👇 Customer
Route::get('customerForm', fn() => view('BackEnd.pages.Customer.ADD'));
Route::post('customerForm', [CustomerController::class, 'ADDCustomer']);
Route::get('CustomerTable', [CustomerController::class, 'showCustomer']);



//////////////////////////////////////////////ADD TO CART///////////////////////////////////////////////////////
use App\Http\Controllers\CartController;

Route::get('/cart', [CartController::class, 'cart'])->name('cart.view');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/remove-from-cart', [CartController::class, 'removeCart'])->name('cart.remove');


Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', function () {
    return view('frantEnd.pages.cart');
})->name('cart.view');

Route::delete('/cart/remove/{id}', function ($id) {
    $cart = session()->get('cart', []);
    unset($cart[$id]);
    session()->put('cart', $cart);
    return redirect()->route('cart.view')->with('success', 'Item removed!');
})->name('cart.remove');
use App\Http\Controllers\OrderController;

Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');

Route::get('/admin/orders', [OrderController::class, 'showOrders'])->name('admin.orders');
Route::get('/admin/orders/{id}', [OrderController::class, 'showOrder'])->name('order.show');
//Route::get('/showOrder',[OrderController::class,'showOrder']);
Route::get('/admin/child-orders', [ChildOrderController::class, 'index'])->name('child.orders');



// Route::post('/admin/orders/{id}/confirm', [OrderController::class, 'confirmOrder'])->name('admin.orders.confirm');

Route::post('/admin/orders/{order}/confirm', [OrderController::class, 'confirmOrder'])->name('admin.orders.confirm');

Route::post('/admin/send-msg-all', [MessageController::class, 'sendToAll'])->name('admin.send.msg.all');




 Route::get('/notification', function () {
    return view('BackEnd.pages.notification.sendmsg');
});
Route::post('/admin/order/confirm/{id}', [OrderController::class, 'confirmOrder'])->name('admin.order.confirm');


