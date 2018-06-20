<?php

Route::group(['namespace' => 'Admins', 'domain' => 'admin.marketplace.corvenik.com'], function () {
    Auth::routes();

    Route::get('/{any}', 'SpaController@index')->where('any', '.*')->name('admins.index');
});

Route::group(['namespace' => 'Users', 'domain' => 'marketplace.corvenik.com'], function () {
    Route::get('/{any}', 'SpaController@index')->where('any', '.*')->name('users.index');
});
