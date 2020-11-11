<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'country/{country}/city'], function () {
    Route::get('/', 'CityController@index');
    Route::get('/{city}', 'CityController@show');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/', 'CityController@store');
        Route::put('/{city}', 'CityController@update');
        Route::delete('/{city}', 'CityController@destroy');
    });
});
