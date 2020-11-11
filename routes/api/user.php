<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function () {
    Route::get('/', 'UserController@index');
    Route::get('/{user}', 'UserController@show');
    Route::put('/{user}', 'UserController@update');
    Route::delete('/{user}', 'UserController@destroy');

    Route::post('/{user}/address', 'UserController@storeAddress');
    Route::put('/{user}/address/{address}', 'UserController@updateAddress');
    Route::delete('/{user}/address/{address}', 'UserController@destroyAddress');

    Route::post('/{user}/role/{role}', 'UserController@attachRole');
    Route::delete('/{user}/role/{role}', 'UserController@detachRole');
});
