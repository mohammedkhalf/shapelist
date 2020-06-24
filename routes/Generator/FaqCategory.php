<?php
/**
 * FaqCategory
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'FaqCategory'], function () {
        Route::resource('faqcategories', 'FaqCategoriesController');
        //For Datatable
        Route::post('faqcategories/get', 'FaqCategoriesTableController')->name('faqcategories.get');
    });
    
});