<?php
/**
 * Promotion
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Promotion'], function () {
        Route::resource('promotions', 'PromotionsController');
        //For Datatable
        Route::post('promotions/get', 'PromotionsTableController')->name('promotions.get');
    });
    
});