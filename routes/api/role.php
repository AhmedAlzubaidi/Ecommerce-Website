<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'role'], function () {
    Route::get('/', 'RoleController@index');
    Route::get('/{role}', 'RoleController@show');
    
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/', 'RoleController@store');
        Route::put('/{role}', 'RoleController@update');
        Route::delete('/{role}', 'RoleController@destroy');

        Route::post('/{role}/privilege/{privilege}', 'RoleController@attachPrivilege');
        Route::delete('/{role}/privilege/{privilege}', 'RoleController@detachPrivilege');
    });
});
