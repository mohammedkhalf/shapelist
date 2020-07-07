<?php
/**
 * Cart
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Cart'], function () {
        Route::resource('carts', 'CartsController');
        //For Datatable
        Route::post('carts/get', 'CartsTableController')->name('carts.get');
    });
    
});