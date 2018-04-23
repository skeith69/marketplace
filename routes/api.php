<?php

Route::group(['namespace' => 'Admins', 'domain' => 'admin.marketplace.dev'], function () {
    // Authentication
    Route::get('/auth/get-admin', 'AuthController@admin');

    // Admins
    Route::resource('admins', 'AdminsController', [
        'only' => [
            'index', 'store', 'show', 'update', 'destroy'
        ]
    ]);

    // Categories
    Route::get('categories/retrieve-all-categories', 'CategoriesController@all')->name('categories.get-all-categories');
    Route::resource('categories', 'CategoriesController', [
        'only' => [
            'index', 'store', 'show', 'update', 'destroy'
        ]
    ]);

    // Product
    Route::resource('products', 'ProductsController', [
        'only' => [
            'index', 'store', 'show', 'update', 'destroy'
        ]
    ]);

    // Stores
    Route::get('stores/retrieve-all-stores', 'StoresController@all')->name('stores.get-all-stores');
    Route::resource('stores', 'StoresController', [
        'only' => [
            'index', 'store', 'show', 'update', 'destroy'
        ]
    ]);
});

Route::group(['namespace' => 'Users', 'domain' => 'marketplace.dev'], function () {
    //
});
