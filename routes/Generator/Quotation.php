<?php
/**
 * Quotation
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Quotation'], function () {
        Route::resource('quotations', 'QuotationsController');
        //For Datatable
        Route::post('quotations/get', 'QuotationsTableController')->name('quotations.get');
    });
    
});