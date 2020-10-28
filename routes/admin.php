<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/
// auth
Route::get('/', [
    'uses' => 'LoginController@index', 
    'middleware' => 'guest'
])->name('admin');
Route::post('checkLogin', [
    'uses' => 'LoginController@checkLogin'
]);
Route::get('logout', [
    'uses' => 'LoginController@logout',
    'middleware' => 'admin'
]);
Route::get('forgot', [
    'uses' => 'LoginController@forgot',
]);
Route::post('sendForgot', [
    'uses' => 'LoginController@sendForgot',
]);
Route::get('resetPassword', [
    'uses' => 'LoginController@resetPassword',
]);
Route::post('sendResetPassword', [
    'uses' => 'LoginController@sendResetPassword',
]);

// category
Route::get('/category', [
    'uses' => 'CategoryController@index',
    'middleware' => 'admin'
]);
Route::post('/getDataCategory', [
    'uses' => 'CategoryController@getDataCategory',
    'middleware' => 'admin'
]);
Route::post('/saveCategory', [
    'uses' => 'CategoryController@store',
    'middleware' => 'admin'
]);
Route::get('/getCategoryById/{id}', [
    'uses' => 'CategoryController@edit',
    'middleware' => 'admin'
]);
Route::post('/updateCategory/{id}', [ 
    'uses' => 'CategoryController@update',
    'middleware' => 'admin'
]);
Route::post('/deleteCategory/{id}', [ 
    'uses' => 'CategoryController@delete',
    'middleware' => 'admin'
]);
Route::post('/updateStatusCategory', [
    'uses' => 'CategoryController@updateStatus',
    'middleware' => 'admin'
]);

//product
Route::get('/product', [
    'uses' => 'ProductController@index',
    'middleware' => 'admin'
]);
Route::post('/getDataProduct', [
    'uses' => 'ProductController@getDataProduct',
    'middleware' => 'admin'
]);
Route::post('/saveProduct', [
    'uses' => 'ProductController@store',
    'middleware' => 'admin'
]);
Route::get('/getProductById/{id}', [
    'uses' => 'ProductController@edit',
    'middleware' => 'admin'
]);
Route::post('/updateProduct/{id}', [ 
    'uses' => 'ProductController@update',
    'middleware' => 'admin'
]);
Route::post('/deleteProduct/{id}', [ 
    'uses' => 'ProductController@delete',
    'middleware' => 'admin'
]);
Route::post('/updateStatusProduct', [
    'uses' => 'ProductController@updateStatus',
    'middleware' => 'admin'
]);

//slider
Route::get('/slider', [
    'uses' => 'SliderController@index',
    'middleware' => 'admin'
]);
Route::post('/getDataSlider', [
    'uses' => 'SliderController@getDataSlider',
    'middleware' => 'admin'
]);
Route::post('/saveSlider', [
    'uses' => 'SliderController@store',
    'middleware' => 'admin'
]);
Route::get('/getSliderById/{id}', [
    'uses' => 'SliderController@edit',
    'middleware' => 'admin'
]);
Route::post('/updateSlider/{id}', [ 
    'uses' => 'SliderController@update',
    'middleware' => 'admin'
]);
Route::post('/deleteSlider/{id}', [ 
    'uses' => 'SliderController@delete',
    'middleware' => 'admin'
]);
Route::post('/updateStatusSlider', [
    'uses' => 'SliderController@updateStatus',
    'middleware' => 'admin'
]);

//post
Route::get('/post', [
    'uses' => 'PostController@index',
    'middleware' => 'admin'
]);
Route::post('/getDataPost', [
    'uses' => 'PostController@getDataPost',
    'middleware' => 'admin'
]);
Route::post('/savePost', [
    'uses' => 'PostController@store',
    'middleware' => 'admin'
]);
Route::get('/getPostById/{id}', [
    'uses' => 'PostController@edit',
    'middleware' => 'admin'
]);
Route::post('/updatePost/{id}', [ 
    'uses' => 'PostController@update',
    'middleware' => 'admin'
]);
Route::post('/deletePost/{id}', [ 
    'uses' => 'PostController@delete',
    'middleware' => 'admin'
]);
Route::post('/updateStatusPost', [
    'uses' => 'PostController@updateStatus',
    'middleware' => 'admin'
]);

//order
Route::get('/order', [
    'uses' => 'OrderController@index',
    'middleware' => 'admin'
]);
Route::post('/getDataOrder', [
    'uses' => 'OrderController@getDataOrder',
    'middleware' => 'admin'
]);
Route::post('/updateStatusOrder', [
    'uses' => 'OrderController@updateStatus',
    'middleware' => 'admin'
]);
Route::get('/getOrderDetail/{id}', [
    'uses' => 'OrderController@getOrderDetail',
    'middleware' => 'admin'
]);

//user
Route::get('/user', [
    'uses' => 'UserController@index',
    'middleware' => 'admin'
]);
Route::post('/getDataUser', [
    'uses' => 'UserController@getDataUser',
    'middleware' => 'admin'
]);
Route::post('/updateStatusUser', [
    'uses' => 'UserController@updateStatus',
    'middleware' => 'admin'
]);
Route::get('/getOrdersOfUser/{id}', [
    'uses' => 'UserController@getOrdersOfUser',
    'middleware' => 'admin'
]);

// dashboard
Route::get('/dashboard', [
    'uses' => 'DashboardControler@index',
    'middleware' => 'admin'
]);

// statistic
Route::get('/statistic', [
    'uses' => 'StatisticController@index',
    'middleware' => 'admin'
]);





