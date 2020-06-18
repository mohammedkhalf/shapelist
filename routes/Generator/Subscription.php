<?php
/**
 * Subscription
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Subscription'], function () {
        Route::resource('subscriptions', 'SubscriptionsController');
        Route::get('/subscriptions/subscribers/{id}', 'SubscriptionsController@subscribers')->name('subscriptionDetails');
        Route::get('/unsubscriber', 'SubscriptionsController@unsubscribers')->name('subscriptions.unsubscribe');
        //For Datatable
        Route::post('subscriptions/get', 'SubscriptionsTableController')->name('subscriptions.get');


        
    });
    
});