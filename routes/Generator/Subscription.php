<?php
/**
 * Subscription
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Subscription'], function () {
        Route::resource('subscriptions', 'SubscriptionsController');
        Route::get('/subscriptions/subscriptionDetails/{id}', 'SubscriptionsController@subscriptionDetails')->name('subscriptionDetails');
        //For Datatable
        Route::post('subscriptions/get', 'SubscriptionsTableController')->name('subscriptions.get');


        
    });
    
});