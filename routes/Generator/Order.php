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

         //For File download
         Route::get('filedownload/{order}', 'OrdersController@fileDownload')->name('filedownload');


    });
    
});