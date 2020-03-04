<?php

/*
 * Products Management
 */
Route::group(['namespace' => 'Products'], function () {
    Route::resource('products', 'ProductsController', ['except' => ['show']]);
    
    // //For DataTables
    // Route::post('faqs/get', 'FaqsTableController')->name('faqs.get');

    // // Status
    // Route::get('faqs/{faq}/mark/{status}', 'FaqStatusController@store')->name('faqs.mark')->where(['status' => '[0,1]']);
});
