<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'product'], function () {
    Route::get('/', 'ProductController@index');
    Route::get('/{product}', 'ProductController@show');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/', 'ProductController@store');
        Route::put('/{product}', 'ProductController@update');
        Route::delete('/{product}', 'ProductController@destroy');

        Route::post('/{product}/option', 'ProductController@storeOption');
        Route::delete('/{product}/option/{option}', 'ProductController@destroyOption');
    });
});
