<?php
/**
 * Delivery
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Delivery'], function () {
        Route::resource('deliveries', 'DeliveriesController');
        //For Datatable
        Route::post('deliveries/get', 'DeliveriesTableController')->name('deliveries.get');
    });
    
});