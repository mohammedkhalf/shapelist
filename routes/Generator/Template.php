<?php
/**
 * Template
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Template'], function () {
        Route::resource('templates', 'TemplatesController');
        //For Datatable
        Route::post('templates/get', 'TemplatesTableController')->name('templates.get');
    });
    
});