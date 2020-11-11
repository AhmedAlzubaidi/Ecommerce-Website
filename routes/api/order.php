<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'order', 'middleware' => 'auth:api'], function () {
    Route::get('/', 'OrderController@index');
    Route::post('/', 'OrderController@store');
    Route::get('/{order}', 'OrderController@show');
    Route::put('/{order}', 'OrderController@update');
    Route::delete('/{order}', 'OrderController@destroy');
});
