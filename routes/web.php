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

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::get('/','HomeController@index')->name('/');

Route::resource('shop', 'ProductController', [
  'names'=>[
    'index' => 'shop',
    ]
]);

Route::resource('cart', 'CartController',['names'=>[
  'index' => 'cart',
  'store'=>'store',
  'show'=>'show'
  ]]);
Route::delete('emptyCart', 'CartController@emptyCart');
Route::post('switchToWishlist/{id}', 'CartController@switchToWishlist');


Route::resource('checkout', 'CheckoutController', ['names'=>[
  'index' => 'checkout',
  'store'=>'paypal/payment/execute/',
  'show'=>'checkout/response/{id}'
  ]]);
Route::get('checkout/response/{id}','CheckoutController@checkoutResponse')->name('checkout/response/{id}');
Route::get('json/checkout/payments','CheckoutController@getPaymentJSONData')->name('json/checkout/payments');

Route::resource('wishlist', 'WishlistController');
Route::delete('emptyWishlist', 'WishlistController@emptyWishlist');
Route::post('switchToCart/{id}', 'WishlistController@switchToCart');
Route::post('nested-object', 'CheckoutController@testNested')->name('nested-object');


Route::group(['prefix' => 'admin'], function () {
     Voyager::routes();
    //Overrides routes
     Route::resource('orders','OrderController');
   });
Route::get('json/orders','OrderController@getJsonOrders')->name('json/orders');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('products','ProductController@getProducts')->name('products');
Route::get('search','ProductController@getSearch')->name('search');
Route::post('search','ProductController@getSearch')->name('search');

Route::group(['prefix' => 'dashboard'], function () {

   Route::get('/','DashboardController@index');
   Route::get('search','ProductController@getSearch')->name('search');
   Route::post('search','ProductController@getSearch')->name('search');
});
