<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1', 'as' => 'v1.'], function () {

    Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function () {

        Route::post('register', 'RegisterController@register');
        Route::post('login', 'AuthController@login');

        // Password Reset
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
        Route::get('find/{token}', 'ForgotPasswordController@find');
        Route::post('password-reset', 'ForgotPasswordController@resetPassword')->name('password.reset');
        // Redirect After Confirmation 
        Route::get('/email/confirm','ForgotPasswordController@redirectAfterConfirm')->name('confirm.redirect');
        Route::get('/redirect', function(){
            return 123;
        })->name('redirect.front');
        
        //=============== change password ===================
        //================================================
    });

    Route::group(['middleware' => ['auth:api']], function () {

        Route::group(['prefix' => 'auth'], function () {
            Route::post('logout', 'AuthController@logout');
            Route::get('user-data/{id}', 'AuthController@userData');
            Route::post('password/change', 'AuthController@changePassword');
            Route::put('update-profile', 'AuthController@updateProfile');
            //Return user from token 
            Route::get('/me','AuthController@getUser');
        });
        // Users
        Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);
        Route::post('users/delete-all', 'UsersController@deleteAll');
        //@todo need to change the route name and related changes
        Route::get('deactivated-users', 'DeactivatedUsersController@index');
        Route::get('deleted-users', 'DeletedUsersController@index');
        // Roles
        Route::resource('roles', 'RolesController', ['except' => ['create', 'edit']]);
        // Permission
        Route::resource('permissions', 'PermissionController', ['except' => ['create', 'edit']]);
        // Page
        Route::resource('pages', 'PagesController', ['except' => ['create', 'edit']]);
        // Blog Categories
        Route::resource('blog_categories', 'BlogCategoriesController', ['except' => ['create', 'edit']]);
        // Blog Tags
        Route::resource('blog_tags', 'BlogTagsController', ['except' => ['create', 'edit']]);
        // Blogs
        Route::resource('blogs', 'BlogsController', ['except' => ['create', 'edit']]);

        //==================================== apiResource ==================================================
        // Products
        // Templates
        Route::apiResource('/templates', 'TemplateController');
        // platforms
        Route::apiResource('/platforms', 'PlatformController');
        // Addons
        Route::apiResource('/addons', 'AddonController');
        //Coupons
        Route::apiResource('/coupons', 'CouponController');
        //Orders Status
        Route::apiResource('/orders_status', 'OrderStatusController');
        //Locations
        Route::apiResource('locations', 'LocationController');
         
        //download Media
        Route::get('mediaFile/{orderId}','OrderController@getMedia');
        //subscriptions
        Route::get('subscriptions/subscribe/{id}/{resource_id}', 'SubscriptionsController@subscribe');
        //subscription update points
        Route::put('subscriptions/updatePoints', 'SubscriptionsController@updatePoints');
        //subscriptions payment
        //Cart Section & Payment Order
        Route::apiResource('cart', 'CartController');
        //get checkout id
        Route::post('/prepare-checkout', 'CartController@prepareCheckout');
        //subscription prepare checkout
        Route::post('/subscription/prepare-checkout', 'SubscriptionsController@subscriptionPrepareCheckout');
        //post resource data + order data 
        Route::post('/resource-with-order','CartController@resourceOrder');
        
        Route::get('checkouts/{checkoutId}/payment','CartController@getStatus');
        Route::post('/update-payment-Info','OrderController@savePaymentInfo');
        // download Invoice for order
        Route::get('orders/{orderId}/download-Invoice','OrderController@downloadInvoice');
        //order download from S3
        Route::get('downloadLink/{orderId}','OrderController@orderDownload');
        // Return user downloads
        Route::get('/download/{orderId}','OrderController@myDownload');
        //new develop
}); //auth:api

        //VAT
        Route::get('quotation/vat', 'QuotationController@vat');
        //ON-SET
        Route::get('quotation/onSet', 'QuotationController@onSet');
        //Music Samples
        Route::apiResource('/music_samples', 'MusicSamplesController'); 
        // Faqs
        Route::resource('faqs', 'FaqsController', ['except' => ['create', 'edit']]);
        Route::get('faqsCategories','FaqsController@category');
        //Faqs Categories
        Route::get('faq/general','FaqsController@general');
        Route::get('faq/package','FaqsController@package');
        Route::get('faq/subscription','FaqsController@subscription');
        //packages Management
        Route::apiResource('packages', 'PackageController');
        //Subscriptions Management
        Route::apiResource('subscriptions', 'SubscriptionsController');
        //products Management
        Route::apiResource('/products', 'ProductController');
         //Deliveries
         Route::apiResource('/deliveries', 'DeliveryController');      
});