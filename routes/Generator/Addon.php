<?php
/**
 * Addon
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Addon'], function () {
        Route::resource('addons', 'AddonsController');
        //For Datatable
        Route::post('addons/get', 'AddonsTableController')->name('addons.get');
    });
    
});