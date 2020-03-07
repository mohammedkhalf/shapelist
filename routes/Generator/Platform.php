<?php
/**
 * Platform
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Platform'], function () {
        Route::resource('platforms', 'PlatformsController');
        //For Datatable
        Route::post('platforms/get', 'PlatformsTableController')->name('platforms.get');
    });
    
});