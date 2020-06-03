<?php
/**
 * Payment
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Payment'], function () {
        Route::resource('payments', 'PaymentsController');
        Route::get('/trash', 'PaymentsController@trash')->name('trash');
        Route::get('/trash/view', 'PaymentsController@viewTrash')->name('viewTrash');
        Route::get('/trash/restore', 'PaymentsController@restore')->name('restore');

        //For Datatable
        Route::post('payments/get', 'PaymentsTableController')->name('payments.get');
    });
    
});