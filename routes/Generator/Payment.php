<?php
/**
 * Payment
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Payment'], function () {
        Route::resource('payments', 'PaymentsController');
        Route::get('/payment/trash', 'PaymentsController@trash')->name('trash');
        Route::get('/payment/trash/view/{id}', 'PaymentsController@viewTrash')->name('viewTrash');
        Route::get('/payment/trash/restore/{id}', 'PaymentsController@restore')->name('restore');

        //For Datatable
        Route::post('payments/get', 'PaymentsTableController')->name('payments.get');
    });
    
});