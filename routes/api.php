<?php

Route::group(['namespace' => 'Admins', 'domain' => 'admin.marketplace.dev'], function () {
    // Authentication
    Route::get('auth/get-admin', 'AuthController@getAdmin');

    // Admins
    Route::get('admins/{admin}/assigned-roles', 'AdminsController@getAssignedRoles');
    Route::post('admins/toggle-role', 'AdminsController@toggleRole')->name('admins.toggle-role');
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

    // Permissions
    Route::get('permissions/retrieve-all-permissions', 'PermissionsController@all')->name('permissions.get-all-permissions');
    Route::resource('permissions', 'PermissionsController', [
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

    // Roles
    Route::get('roles/retrieve-all-roles', 'RolesController@all')->name('roles.get-all-roles');
    Route::get('roles/{role}/assigned-permissions', 'RolesController@getAssignedPermissions');
    Route::post('roles/toggle-permission', 'RolesController@togglePermission')->name('roles.toggle-permission');
    Route::resource('roles', 'RolesController', [
        'only' => [
            'index', 'store', 'show', 'update', 'destroy'
        ]
    ]);

    // Sales
    Route::get('sales/today-sales', 'SalesController@todaySales')->name('stores.today-sales');
    Route::get('sales/current-week-sales', 'SalesController@currentWeekSales')->name('stores.current-week-sales');
    Route::get('sales/current-month-sales', 'SalesController@currentMonthSales')->name('stores.current-month-sales');
    Route::resource('sales', 'SalesController', [
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
    Route::get('/stores/{storeId}/products', 'StoresController@products');
    Route::get('/stores', 'StoresController@index');
});
