<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('/#purchase', 'PurchaseController@show');
Route::post('/savePurchase', 'PurchaseController@savePurchase');
Route::post('/authenticate', 'AuthController@authenticate');
Route::get('/logout', 'AuthController@logout');
Route::post('/getProducts', 'ProductController@getList');
Route::get('/getShops', 'ShopController@getList');
Route::get('/getCountries', 'ShopController@getCountryList');
Route::get('/getProductsNames', 'ProductController@getProductsNames');
Route::post('/newShop', 'ShopController@newShop');
Route::post('/newProduct', 'ProductController@newProduct');
