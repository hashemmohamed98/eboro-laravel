<?php

/*
|--------------------------------------------------------------------------
| dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('dashboard')->group(function ()
{
    Route::middleware(['auth','Lock','lang','active','WebVerified'])->group(function ()
    {
        Route::get('provider/{name}', 'Dashboard\HomeController@index');
        Route::get('Orders/{name}', 'Dashboard\HomeController@Orders');
        Route::get('update_orders/{name}', 'Dashboard\HomeController@update_orders');
        Route::get('update_time/{name}', 'Dashboard\HomeController@update_time');
        Route::get('cashers/{name}', 'Dashboard\HomeController@cashers');
        Route::get('resturant/{name}', 'Dashboard\HomeController@resturant');
        Route::get('client/{name}', 'Dashboard\HomeController@client');
        Route::get('delivery/{name}', 'Dashboard\HomeController@delivery');
        Route::get('sauce/{name}', 'Dashboard\HomeController@sauce');
        Route::get('beveraged/{name}', 'Dashboard\HomeController@beveraged');
        Route::get('inner_types/{name}', 'Dashboard\HomeController@get_type');
        Route::post('add/product-sauce/{id}', 'Dashboard\HomeController@add_sauce');
        Route::post('add/type', 'Dashboard\HomeController@add_type');
        Route::post('edit/type/{id}', 'Dashboard\HomeController@change_type');
        Route::post('edit/inner_types/{id}', 'Dashboard\HomeController@change_inner_types');
        Route::post('delete/type/{id}', 'Dashboard\HomeController@delete_type');
        Route::post('delete/inner_types/{id}', 'Dashboard\HomeController@delete_inner_types');
        Route::post('edit/order ', 'Dashboard\HomeController@edit_order');
        Route::post('add/inner_types', 'Dashboard\HomeController@add_inner_types');

    });
});
