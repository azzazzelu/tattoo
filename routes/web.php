<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromocodeController;
use App\Http\Controllers\TattooController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\Admin;
use App\Models\Products;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('home.home');
// })->name('home');

Route::get('/', [TattooController::class, 'index'])->name('home');
Route::get('/promoCodes', [PromocodeController::class , 'index'])->name('promoCodes');

Route::get('/contacts', function () {
    return view('contacts.index');
})->name('contacts');

Route::group( ['prefix' => 'catalog'] ,function(){
    Route::get("/",[ProductController::class,'index'])->name('catalog');
    // Route::get('/category/{categor}', [ProductController::class,'showCatalog'])->name('catalog_categories.show');
    Route::get('/category', [ProductController::class,'category']);
    Route::get('/category/{categoryList}', [ProductController::class,'showCatalog'])->name('catalog.categories.show');
    Route::get('/{id}', [ProductController::class,'showProducts'])->name('product.show');
    Route::get('/brands/{brandList}', [ProductController::class,'showBrands'])->name('catalog.brands.show');
});

Route::get('/basket', [CartController::class, 'index'])->name('basket.index');
Route::post('/add-to-basket', [CartController::class, 'addToCart'])->name('item.add');
Route::delete('/remove-from-basket/{itemId}', [CartController::class, 'removeFromCart'])->name('item.remove');
Route::delete('/clear-from-basket/{itemId}', [CartController::class, 'clearCart'])->name('item.clear');
Route::post('/activate-promocode', [PromocodeController::class, 'activate'])->name('promocode');

// Route::get('/checkout', [OrderController::class, 'showForm'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout');

Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'create'])->name('register');
    Route::post('/register', [UserController::class, 'store'])->name('user.store');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');

    // Route::get('/forgot-password', function () {
    //     return view('user.forgot-password');
    // })->name('password.request');

    // Route::post('/forgot-password', [UserController::class, 'forgotPasswordStore'])->middleware('throttle:3,1')->name('password.email');

    // Route::get('/reset-password/{token}', function (string $token) {
    //     return view('user.reset-password', ['token' => $token]);
    // })->name('password.reset');

    // Route::post('/reset-password', [UserController::class, 'resetPasswordUpdate'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/verify', function () {
        // return view('user.verify-email');
        return redirect()->route('home')->with('message', ' Спасибо за регистрацию!');
    })->name('verification.notice');

    // Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    //     $request->fulfill();

    //     return redirect('dashboard');
    // })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Ссылка для подтверждения отправлена!');
    })->middleware('throttle:3,1')->name('verification.send');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});



Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => [Admin::class]], function () {
    Route::get('/', [AdminController::class, 'main'])->name('admin');
});
