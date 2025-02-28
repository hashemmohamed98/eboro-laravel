<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\DelievryController;
Route::middleware(['auth:api','active'])->group(function () {
    Route::post('verifyEmail', [UserController::class,'verifyEmail']);
    Route::get('send_verifyEmail', [UserController::class,'Re_verify']);
});

Route::middleware('apiLang')->group(function () {
    Route::post('register', [UserController::class,'register']);
    Route::post('login', [UserController::class,'login']);
    Route::post('forgetPassword', [UserController::class,'forgetPassword']);
    Route::post('resetPassword', [UserController::class,'resetPassword']);
    Route::get('status', [AdminController::class,'State']);
    Route::get('get/Filter_types/{id}', 'Api\FilterController@Filter_type');
    Route::post('login/social', [UserController::class,'socialLogin']);
    Route::get('setting-details', 'SiteController@settingDetail');
    Route::get('get/categories', 'Api\CategoryController@getAll');
    Route::get('get/providers', 'Api\ProviderController@getAll');
    Route::post('get/provider-by-cat', 'Api\ProviderController@getByCat');
    Route::post('filter/branch-product', 'Api\BranchProductController@filter');

    //auth
    Route::middleware(['apiAuth','active','verify_user'])->group(function ()
    {
        Route::post('dashboard/add/chat', 'Api\ChatController@add');

        Route::get('logout', [UserController::class,'logout'])->middleware('active');
        Route::get('user-details', [UserController::class,'userDetails']);
        Route::post('changePassword', [UserController::class,'changePassword']);
        Route::post('edit-profile', [UserController::class,'editProfile']);
        Route::post('edit-user/{id}', [UserController::class,'edit']);
        Route::post('edit-location', [UserController::class,'editLocation']);
        Route::get('delete-user/{id}', [UserController::class,'delete']);
        Route::get('user-branches', [UserController::class,'userBranches']);
        Route::get('user-favorite', [UserController::class,'favorite']);
        Route::get('user-Rates', [UserController::class,'Rates']);

        Route::get('distance2/{lat}/{long}', 'SiteController@distance2');

        Route::post('create/category', 'Api\CategoryController@create');
        Route::post('edit/category/{id}', 'Api\CategoryController@edit');
        Route::get('get/category/{id}', 'Api\CategoryController@getById');
        Route::get('delete/category/{id}', 'Api\CategoryController@delete');

        Route::post('create/provider', 'Api\ProviderController@create');
        Route::post('edit/provider/{id}', 'Api\ProviderController@edit');
        Route::post('edit_range/provider/{id}', 'Api\ProviderController@edit_range');
        Route::get('get/provider/{id}', 'Api\ProviderController@getById');
        Route::get('delete/provider/{id}', 'Api\ProviderController@delete');
        Route::get('get/user-provider', 'Api\ProviderController@userProviders');
        Route::post('add-to-favorite', 'Api\ProviderController@AddToFav');
        Route::post('add-to-Rate', 'Api\ProviderController@AddToRate');
        Route::post('lock/provider', 'Api\ProviderController@lock');

        Route::post('create/branch', 'Api\BranchController@create');
        Route::post('edit/branch/{id}', 'Api\BranchController@edit');
        Route::get('get/branch/{id}', 'Api\BranchController@getById');
        Route::get('get/branchs', 'Api\BranchController@getAll');
        Route::get('delete/branch/{id}', 'Api\BranchController@delete');
        Route::post('get/provider-branch', 'Api\BranchController@providerBranchs');

        Route::post('create/branch-staff', 'Api\BranchStaffController@create');
        Route::post('edit/branch-staff/{id}', 'Api\BranchStaffController@edit');
        Route::get('get/branch-staff/{id}', 'Api\BranchStaffController@getById');
        Route::post('filter/branch-staff', 'Api\BranchStaffController@filterStaff');
        Route::get('delete/branch-staff/{id}', 'Api\BranchStaffController@delete');

        Route::post('create/branch-product', 'Api\BranchProductController@create');
        Route::post('edit/branch-product/{id}', 'Api\BranchProductController@edit');
        Route::get('get/branch-product/{id}', 'Api\BranchProductController@getById');
        Route::get('get/product-sauce/{id}', 'Api\BranchProductController@productSauce');
        Route::get('delete/branch-product/{id}', 'Api\BranchProductController@delete');
        Route::get('new-product', 'Api\BranchProductController@newProducts');
        Route::get('most-sell-product', 'Api\BranchProductController@mostSellProducts');

        Route::post('create/product-sauce', 'Api\ProductSauceController@create');
        Route::get('delete/product-sauce/{id}', 'Api\ProductSauceController@delete');

        Route::get('get/product-meal/{id}', 'Api\MealController@get');
        Route::post('add/product-meal', 'Api\MealController@add');
        Route::post('edit/product-meal/{id}', 'Api\MealController@edit');
        Route::get('delete/product-meal /{id}', 'Api\MealController@delete');

        Route::get('get/chat/{id}', 'Api\ChatController@get');
        Route::get('get/delivery/chat/{id}', 'Api\ChatController@get_dl');
        Route::post('add/chat', 'Api\ChatController@add');
        Route::post('add/chat/delivery', 'Api\ChatController@add_delivery');
        Route::get('delete/chat/{id}', 'Api\ChatController@delete');


        Route::post('add/delivery-calendar', 'Api\CalendarController@create');
        Route::get('get/delivery-calendar', 'Api\CalendarController@getAll');
        Route::post('delete/delivery-calendar', 'Api\CalendarController@delete');


        Route::post('add-cart', 'Api\CartController@add');
        Route::get('user-cart', 'Api\CartController@get');
        Route::get('delete-cart-item/{id}', 'Api\CartController@delete');
        Route::get('rest-cart-item', 'Api\CartController@rest');

        Route::post('add-order', 'Api\OrderController@create');
        Route::post('edit-order', 'Api\OrderController@edit');
        Route::post('search-order', 'Api\OrderController@search');
        Route::post('delete-order', 'Api\OrderController@delete');
        Route::post('delivery-for-order', 'Api\OrderController@findDelivery');
        Route::post('add-order-rate', 'Api\OrderController@rate_order');

        Route::post('create/promo', 'Api\PromoController@add');
        Route::post('edit/promo/{id}', 'Api\PromoController@edit');
        Route::get('delete/promo/{id}', 'Api\PromoController@delete');

        Route::post('contact-us', 'ContactUsController@createApi');
        Route::get('user/contact', 'ContactUsController@userContact');
        Route::get('contact-details/{id}', 'ContactUsController@contactDetails');

        Route::get('get/Filter/{id}', 'Api\FilterController@Filter');

        Route::post('Admin_Delivery_Orders_Report', 'ReportController@Admin_Delivery_Orders_Report');
        Route::get('delivery-fees/{providerId}/{lat}/{long}', [DelievryController::class,'calculateDeliveryFee']);
    });
});
