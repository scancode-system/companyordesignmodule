<?php

Route::prefix('exports')->group(function() {
    Route::get('txt/orders/ordesign', 'ExportController@txtOrders')->name('exports.txt.orders.ordeisgn');
});