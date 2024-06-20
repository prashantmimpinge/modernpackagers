<?php

use Illuminate\Support\Facades\Route;

Route::get('query-product', [
    'as' => 'admin.flash_sales.index',
    'uses' => 'QueryProductController@index',
    'middleware' => 'can:admin.flash_sales.index',
]);

Route::get('query-product/create', [
    'as' => 'admin.flash_sales.create',
    'uses' => 'QueryProductController@create',
    'middleware' => 'can:admin.flash_sales.create',
]);

// Route::post('flash-sales', [
//     'as' => 'admin.flash_sales.store',
//     'uses' => 'QueryProductController@store',
//     'middleware' => 'can:admin.flash_sales.create',
// ]);

// Route::get('flash-sales/{id}/edit', [
//     'as' => 'admin.flash_sales.edit',
//     'uses' => 'QueryProductController@edit',
//     'middleware' => 'can:admin.flash_sales.edit',
// ]);

// Route::put('flash-sales/{id}', [
//     'as' => 'admin.flash_sales.update',
//     'uses' => 'QueryProductController@update',
//     'middleware' => 'can:admin.flash_sales.edit',
// ]);

// Route::delete('flash-sales/{ids?}', [
//     'as' => 'admin.flash_sales.destroy',
//     'uses' => 'QueryProductController@destroy',
//     'middleware' => 'can:admin.flash_sales.destroy',
// ]);
