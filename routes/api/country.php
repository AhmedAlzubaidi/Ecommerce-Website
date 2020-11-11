<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'country'], function () {
    Route::get('/', 'CountryController@index');
    Route::get('/{country}', 'CountryController@show');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/', 'CountryController@store');
        Route::put('/{country}', 'CountryController@update');
        Route::delete('/{country}', 'CountryController@destroy');
    });
});
