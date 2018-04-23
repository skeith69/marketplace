<?php

Route::group(['namespace' => 'Admins', 'domain' => 'admin.marketplace.dev'], function () {
    Auth::routes();
    Route::get('/{any}', 'SpaController@index')->where('any', '.*')->name('admins.index');
});

Route::group(['namespace' => 'Users', 'domain' => 'marketplace.dev'], function () {
    Route::get('/{any}', 'SpaController@index')->where('any', '.*')->name('users.index');
});
