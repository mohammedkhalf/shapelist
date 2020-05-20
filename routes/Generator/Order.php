<?php
/**
 * Order
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Order'], function () {
        Route::resource('orders', 'OrdersController');
        //For Datatable
        Route::post('orders/get', 'OrdersTableController')->name('orders.get');
        // Route::get('orders/promotions/{order}', 'OrdersController@getPromotions')->name('orders.show-promotions');
    });
    
});