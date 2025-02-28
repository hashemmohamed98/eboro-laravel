<?php


Route::prefix('admin')->group(function ()
{
    Route::middleware(['admin','lang','active','WebVerified'])->group(function ()
    {
        Route::get('home', 'AdminController@home');
        Route::get('report', 'AdminController@report');
        Route::get('promo', 'AdminController@promo');
        Route::get('delivery', 'AdminController@delivery');
        Route::get('category', 'AdminController@category');
        Route::get('order', 'AdminController@order');
        Route::get('refund-orders', 'AdminController@refundOrders')->name('refund-order');
        Route::get('update_orders', 'AdminController@update_order');
        Route::get('product', 'AdminController@product');
        Route::get('provider', 'AdminController@provider');
        Route::get('type', 'AdminController@type');
        Route::get('provider/branches/{id}', 'AdminController@provider_branches');
        Route::get('subscriber', 'AdminController@subscribe');
        Route::get('setting', 'AdminController@setting');
        Route::get('setting/edit', 'AdminController@editsetting');
        Route::get('setting/edit_phones', 'AdminController@editsettingphones');
        Route::post('edit_setting/{id}', 'AdminController@edit_setting');
        Route::post('assist_phones/{id}', 'AdminController@assist_phones');
        Route::get('status-user/{id}', 'AdminController@status');

        //Testimonial
        Route::get('test', 'Dashboard\TestmonialController@index');
        Route::post('create/test', 'Dashboard\TestmonialController@create');
        Route::post('edit/test/{id}', 'Dashboard\TestmonialController@edit');
        Route::post('delete/test/{id}', 'Dashboard\TestmonialController@delete');

        //contact
        Route::get('contact', 'ContactUsController@index');
        Route::post('reply-contact/{id}', 'ContactUsController@reply');
        Route::post('delete/contact/{id}', 'ContactUsController@delete');
        Route::get('change-contact-status/{id}', 'ContactUsController@changeState');

        Route::get('update_orders_chat/{id}', 'AdminController@update_orders_chat');
        Route::get('update_orders_chat/delivery/{id}', 'AdminController@update_orders_delivery_chat');
        Route::get('change-system-status/{id}', 'AdminController@changeState');
        Route::get('download/product', 'AdminController@download');
        Route::get('download/type', 'AdminController@typeID');
        Route::get('download/branch', 'AdminController@brunchID');
        Route::get('upload-product-view', 'AdminController@uploadProductView');
        Route::post('upload/product', 'AdminController@import');



    });
});
