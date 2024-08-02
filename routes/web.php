<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrdesEcommerceController;
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
Route::get('/search-city', 'App\Http\Controllers\ProductController@search')->name('search.city');


Route::get('/contato', [\App\Http\Controllers\ContactController::class, 'index']);
Route::post('/contato', [\App\Http\Controllers\ContactController::class, 'sendContactEmail'])->name('contact.send');


Route::get('/politica-privacidade', [\App\Http\Controllers\HomeController::class, 'privacidade'])->name('privacidade');


Route::group(['prefix'=> 'minha-conta'], function (){
    Route::get('/', [\App\Http\Controllers\MyAccountController::class, 'index'])->name('minha-conta');


});

Route::group(['prefix' => 'produtos'], function () {

    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/show/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/destaques', [ProductController::class, 'destaques'])->name('products.destaque');
    Route::get('/novos', [ProductController::class, 'novos'])->name('products.novos');
    Route::get('/collection', [ProductController::class, 'productsCollection'])->name('products.collection');
    Route::get('/showModal/{id}', [ProductController::class, 'showModal'])->name('products.showModal');

    //Route::get('/show/{id}', 'ProductController@showModal' )->name('products.showModal');

});


Route::resource('sobre-nos', 'App\Http\Controllers\AboutUsController');

Route::get('/search-city', 'App\Http\Controllers\CheckoutController@search')->name('search.city');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');

   /* Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [CartController::class, 'cartList'])->name('cart.list');
        Route::post('/add', [CartController::class, 'cartAdd'])->name('cart.add');
        Route::post('/remove-item', [CartController::class, 'removeItenCart'])->name('cart.remove');
    });*/

    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/view', [CartController::class, 'viewCart'])->name('cart.view');

    Route::post('/cart/remove-item', [CartController::class, 'removeItenCart'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');



    Route::get('/checkout/create', [ CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('/checkout/store', [ CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/get-tax-rates', [CheckoutController::class, 'getTaxRates'])->name('getTaxRates');

    Route::group(['prefix' => 'pedidos'], function () {
        //Route::get('/show/{id}', [OrdesEcommerceController::class, 'showModal'])->name('pedidos.showModal');
        //Route::get('/show/{id}', 'OrdesEcommerceController@showModal' )->name('pedidos.showModal');
        Route::get('/list', [OrdesEcommerceController::class, 'getList'])->name('pedidos.list');
        //Route::get('/create/{id}', 'OrdesEcommerceController@create' )->name('order.create');
        //Route::get('/create/{id}', [OrdesEcommerceController::class, 'create'])->name('order.create');
        Route::get('/create/{id}', '\App\Http\Controllers\OrdesEcommerceController@showModal')->name('order.create');
    });


    Route::group(['prefix'=> 'minha-conta'], function (){
        Route::get('/', [\App\Http\Controllers\MyAccountController::class, 'index'])->name('minha-conta');
        Route::get('/details', [\App\Http\Controllers\MyAccountController::class, 'getDetails'])->name('minha-conta-details');
        Route::get('/minhas-compras', [\App\Http\Controllers\MyAccountController::class, 'myShippings'])->name('minhas-compras');
        Route::post('/update-acc', [\App\Http\Controllers\MyAccountController::class, 'updateRegister'])->name('update.register');
    });

    Route::get('/shipping-details/{id}', [\App\Http\Controllers\MyAccountController::class, 'shippingDetails'])->name('shipping-details');

    Route::prefix('')->group(function () {

    });




});

require __DIR__.'/auth.php';
