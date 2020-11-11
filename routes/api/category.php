<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'category'], function () {
    Route::get('/', 'CategoryController@index');
    Route::get('/{category}', 'CategoryController@show');
    
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/', 'CategoryController@store');
        Route::put('/{category}', 'CategoryController@update');
        Route::delete('/{category}', 'CategoryController@destroy');
    });
});
