<?php
/**
 * Package
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Package'], function () {
        Route::resource('packages', 'PackagesController');
        //For Datatable
        Route::post('packages/get', 'PackagesTableController')->name('packages.get');        
    });

    
});