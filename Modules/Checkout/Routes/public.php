<?php

use Illuminate\Support\Facades\Route;

Route::get('checkout', 'CheckoutController@create')->name('checkout.create');
Route::post('checkout', 'CheckoutController@store')->name('checkout.store');


Route::post('checkoutsendOtp','CheckoutController@checkoutsendOtp')->name('checkout.sendOtp');

Route::post('checkoutcheckOtp','CheckoutController@checkoutcheckOtp')->name('checkout.checkOtp');

Route::get('checkout/{orderId}/complete', 'CheckoutCompleteController@store')->name('checkout.complete.store');
Route::get('checkout/complete', 'CheckoutCompleteController@show')->name('checkout.complete.show');

Route::get('checkout/{orderId}/payment-canceled', 'PaymentCanceledController@store')->name('checkout.payment_canceled.store');
