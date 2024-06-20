<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/CustomizedPackaging', 'HomeController@customizedpackaging')->name('customizedpackaging');
