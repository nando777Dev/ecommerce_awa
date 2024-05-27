<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::resource('/', 'App\Http\Controllers\HomeController');

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [CartController::class, 'cartList'])->name('cart.list');
    Route::post('/add', [CartController::class, 'cartAdd'])->name('cart.add');
    Route::post('/remove-item', [CartController::class, 'removeItenCart'])->name('cart.remove');
});

Route::group(['prefix' => 'produtos'], function () {

    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/show/{id}', [ProductController::class, 'show'])->name('products.show');

});


Route::resource('sobre-nos', 'App\Http\Controllers\AboutUsController');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Route::get('cart', [CartController::class, 'index']);


});

require __DIR__.'/auth.php';
