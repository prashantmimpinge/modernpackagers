<?php

use Illuminate\Support\Facades\Route;

Route::post('phone', 'AuthController@postPhone')->name('phone.post');
Route::get('login', 'AuthController@getLogin')->name('login');
Route::post('login', 'AuthController@postLogin')->name('login.post');

Route::get('login/{provider}', 'AuthController@redirectToProvider')->name('login.redirect');
Route::get('login/{provider}/callback', 'AuthController@handleProviderCallback')->name('login.callback');

Route::get('logout', 'AuthController@getLogout')->name('logout');

Route::get('register', 'AuthController@getRegister')->name('register');
Route::post('register', 'AuthController@postRegister')->name('register.post');

Route::post('sendOtp','AuthController@sendOtp')->name('sendOtp');

Route::post('checkOtp','AuthController@checkOtp')->name('checkOtp');

Route::get('password/reset', 'AuthController@getReset')->name('reset');
Route::post('password/reset', 'AuthController@postReset')->name('reset.post');
Route::get('password/reset/{email}/{code}', 'AuthController@getResetComplete')->name('reset.complete');
Route::post('password/reset/{email}/{code}', 'AuthController@postResetComplete')->name('reset.complete.post');
Route::post('/fbuserrevoke','AuthController@dataDeletionCallback');
Route::get('status/fb','AuthController@UserDeletionCallback');
// Route::get('status/fb',function(){
//     return response()->json([
//         'message' => 'user deleted'
//     ], 200);
// });
