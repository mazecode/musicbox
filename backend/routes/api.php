<?php

Route::get('/', function () {
    return response()->json('Welcome to MusicBox API Rest', 200);
});

Route::prefix('auth')
    //->middleware(['ability:owner|admin|root|create-user'])
    ->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');

    // Route to create a new role
    Route::post('role', 'JwtAuthenticateController@createRole');
    // Route to create a new permission
    Route::post('permission', 'JwtAuthenticateController@createPermission');
    // Route to assign role to user
    Route::post('assign-role', 'JwtAuthenticateController@assignRole');
    // Route to attache permission to a role
    Route::post('attach-permission', 'JwtAuthenticateController@attachPermission');

    Route::middleware('auth:api')->group(function () {
        Route::post('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});

Route::middleware('auth:api')->get('/user', function () {
    return request()->user();
});
