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

// login gg
// Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
// Route::get('/callback', 'Auth\LoginController@handleProviderCallback');

//login fb
Route::get('/redirect', 'Auth\LoginController@redirectFb');
Route::get('/callback', 'Auth\LoginController@callbackFb');

// home
Route::get('/', [
    'uses' => 'HomeController@index'
]);

// post
Route::get('/posts', [
    'uses' => 'PostController@index'
]);
Route::get('/post/{id}', [
    'uses' => 'PostController@show'
]);

//search
Route::get('/search', [
    'uses' => 'SearchController@show'
]);

//product
Route::get('/product/{id}', [
    'uses' => 'ProductController@show'
]);
Route::post('/addProductVote', [
    'uses' => 'ProductController@addVote'
]);

//category
Route::get('/category/{id}', [
    'uses' => 'CategoryController@show'
]);

Route::get('/category/{id}', [
    'uses' => 'CategoryController@show'
]);
Route::get('/loadMoreDataCategory', [
    'uses' => 'CategoryController@loadMoreData'
]);

// cart
Route::get('/cart', [
    'uses' => 'CartController@index'
]);
Route::post('/addToCart', [
    'uses' => 'CartController@addCart'
]);
Route::post('/deleteCart/{rowId}', [
    'uses' => 'CartController@deleteCart'
]);
Route::post('/updateCart', [
    'uses' => 'CartController@updateCart'
]);

// checkout
Route::post('/checkout', [
    'uses' => 'CheckoutController@showCheckout'
]);
Route::post('/payment', [
    'uses' => 'CheckoutController@payment'
]);
Route::get('/responsePayment', [
    'uses' => 'CheckoutController@responsePayment'
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function () {

});

