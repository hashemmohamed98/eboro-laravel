<?php

Auth::routes(['verify' => true]);
Route::get('lang/{lang}', 'HomeController@lang');
Route::get('verify', 'SiteController@verify')->middleware('auth');
Route::get('applications', 'SiteController@redirect_applications');

Route::middleware(['CWeb'])->group(function ()
{
    Route::get('/logout', 'HomeController@logout')->middleware('auth');
    Route::get('/', 'SiteController@index');
    Route::get('/category/{id}/{name}', 'SiteController@allCategory');
    Route::get('/Provider/{id}/{name}', 'SiteController@aProvider');
    Route::get('/Branch/{id}/{name}', 'SiteController@aBranch');
    Route::get('/product-details/{id}/{name}', 'SiteController@product_details');
    Route::get('/Sauces-content/{id}', 'SiteController@Sauces');
    Route::get('/distance2/{lat}/{long}', 'SiteController@distance2');
    Route::get('/Profile/{name}', 'SiteController@Profile');
    Route::get('Rate/{provider}/{stars}', 'HomeController@Rate');
    Route::get('Favorite/{provider}', 'HomeController@Favorite');
    Route::post('Comment/{product}', 'HomeController@Comment');
    Route::get('CommentLike/{comment}', 'HomeController@CommentLike');
    Route::get('/deliver/', 'SiteController@becomeDelivery');
    Route::post('/deliver/', 'SiteController@deliveryRegister');
    Route::get('/aboutus/', 'SiteController@aboutus');
    Route::get('/contact/', 'SiteController@contactus');
    Route::get('/privacy/', 'SiteController@privacy');
    Route::get('/category-grid/', 'SiteController@category_grid');
    Route::get('/cart/', 'SiteController@cart')->middleware('auth');
    Route::get('/checkout/', 'SiteController@checkout')->middleware('auth');
    Route::get('/myorder/', 'Api\OrderController@findDelivery')->middleware('auth');
//    Route::get('/menu/', 'SiteController@menu');
    Route::post('/search/', 'SiteController@search');
    Route::get('/search/', 'SiteController@search');
    Route::post('subscribe', 'SiteController@subscribe');
    Route::get('Filter/{id}', 'SiteController@WebFilter');

    // G
    Route::get('Orders_Report/{ID}/{type}/{from}/{to}', 'ReportController@Orders_Report');
    Route::get('Products_Report/{ID}/{type}/{from}/{to}', 'ReportController@Products_Report');
    Route::get('Branches_Report/{ID}/{type}/{from}/{to}', 'ReportController@Branches_Report');
    Route::get('Cashier_Report/{ID}/{type}/{from}/{to}', 'ReportController@Cashier_Report');
    Route::get('Delivery_Report/{ID}/{type}/{from}/{to}', 'ReportController@Delivery_Report');
    Route::get('Delivery_Orders_Report/{ID}/{type}/{from}/{to}', 'ReportController@Delivery_Orders_Report');

    Route::get('handle-payment', 'PayPalPaymentController@handlePayment')->name('make.payment')->middleware('auth');
    Route::get('cancel-payment', 'PayPalPaymentController@paymentCancel')->name('cancel.payment');
    Route::get('payment-success', 'PayPalPaymentController@paymentSuccess')->name('success.payment');

    Route::get('TimeZone/{lon}/{lat}', 'SiteController@get_TimeZone');
    Route::get('set_TimeZone', 'SiteController@set_TimeZone');
    Route::get('test_google', 'SiteController@test_google');


    Route::get('resetpassword', 'SiteController@resetpassword');
    //Route::get('forgetpassword', 'SiteController@forgetpassword');
});



//Route::prefix('emails')->group(function ()
//{
//    Route::get('invoice', function()
//    {
//        $data = \App\Models\Order::first();
//        return view('site.emails.invoice',compact('data'));
//    });
//
//
//    Route::get('verify', function()
//    {
//        $data = \App\Models\User::first();
//        return view('site.emails.verify',compact('data'));
//    });
//});



Route::get('login/facebook', 'Auth\LoginController@redirect_facebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handle_Facebook_allback');

Route::get('login/google', 'Auth\LoginController@redirect_google');
Route::get('login/google/callback', 'Auth\LoginController@handle_google_allback');

Route::get('login/apple', 'Auth\LoginController@redirect_apple');
Route::post('login/apple/callback', 'Auth\LoginController@handle_apple_callback');
