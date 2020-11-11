<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'privilege', 'middleware' => 'auth:api'], function () {
    Route::get('/', 'PrivilegeController@index');
    Route::post('/', 'PrivilegeController@store');
    Route::get('/{privilege}', 'PrivilegeController@show');
    Route::put('/{privilege}', 'PrivilegeController@update');
    Route::delete('/{privilege}', 'PrivilegeController@destroy');
});
