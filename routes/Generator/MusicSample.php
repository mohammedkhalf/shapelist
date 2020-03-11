<?php
/**
 * MusicSample
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'MusicSample'], function () {
        Route::resource('musicsamples', 'MusicSamplesController');
        //For Datatable
        Route::post('musicsamples/get', 'MusicSamplesTableController')->name('musicsamples.get');
    });
    
});