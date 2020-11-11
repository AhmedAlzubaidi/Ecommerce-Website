<?php

use Illuminate\Support\Facades\Route;

Route::post('order/{order}', 'PaymentController@verifyPayment')->middleware('auth:api');
