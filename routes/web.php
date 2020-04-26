<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@index');
Route::get('products', 'HomeController@shop')->name('shop');
Route::get('products/{product}', 'HomeController@details')->name('product.details');
Route::get('categories/{category}', 'HomeController@category')->name('product.category');

Route::get('contact', function (){
    return view('front.contact');
})->name('contact');

Auth::routes(['reset' => false]);


Route::prefix('api/cart')->group(function (){
    Route::get('/', 'Api\ApiCartController@index');
    Route::get('remove/{product}', 'Api\ApiCartController@remove');
    Route::get('clear', 'Api\ApiCartController@clear');
    Route::get('update/{product}', 'Api\ApiCartController@update');
});

Route::prefix('cart')->group(function (){
    Route::get('/', 'CartController@index')->name('cart');
    Route::get('addItem/{product}', 'CartController@addItem')->name('cart.add');
    Route::get('remove/{product}', 'CartController@destroy')->name('cart.remove');
    Route::get('clear', 'CartController@clear')->name('cart.clear');
    Route::post('update', 'CartController@update')->name('cart.update');
});

Route::middleware('auth')->group(function (){
    Route::get('checkout', 'CheckoutController@index')->name('checkout');
    Route::post('validate', 'CheckoutController@formValidate')->name('checkout-validate');
    Route::get('thankyou', function (){
        return view('profile.thankyou');
    });

    Route::get('wishlist/{product}', 'HomeController@addToWishlist')->name('wishlist.add');

    Route::prefix('profile')->group(function (){
        Route::get('/', 'ProfileController@index')->name('profile');
        Route::get('orders', 'ProfileController@orders')->name('profile.orders');
        Route::get('orders/{order}', 'ProfileController@showOrder')->name('profile.showOrder');
        Route::get('address', 'ProfileController@address')->name('profile.address');
        Route::post('updateAddress', 'ProfileController@updateAddress')->name('profile.updateAddress');
        Route::get('password', 'ProfileController@password')->name('profile.password');
        Route::post('updatePassword', 'ProfileController@updatePassword')->name('profile.updatePassword');
        Route::get('wishlist', 'ProfileController@wishlist')->name('wishlist');
    });
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function (){
    Route::get('/', function (){
        return view('admin.index');
    })->name('admin.index');

    Route::get('orders', 'OrderController@index')->name('orders.index');
    Route::post('orders/{order}', 'OrderController@confirm')->name('orders.confirm');
    Route::put('orders/{order}', 'OrderController@cancel')->name('orders.cancel');

    Route::post('favorites/add/{product}', 'ProductController@addToFavorites')->name('favorites.add');
    Route::post('favorites/delete/{product}', 'ProductController@removeFromFavorites')->name('favorites.remove');

    Route::post('sales/add/{product}', 'ProductController@addToSale')->name('sale.add');
    Route::post('sales/remove/{sale}/product/{product}', 'ProductController@removeFromSale')->name('sale.remove');

    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    Route::resource('sales', 'SaleController');
});

