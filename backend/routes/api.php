<?php

Route::get('/', function () {
    return response()->json('Welcome to MusicBox API Rest', 200);
});

Route::prefix('auth')->group(function () {
    // Below mention routes are public, user can access those without any restriction.
    // Create New User
    Route::post('register', 'AuthController@register');
    // Login User
    Route::post('login', 'AuthController@login');

    // Refresh the JWT Token
    Route::get('refresh', 'AuthController@refresh');

    // Below mention routes are available only for the authenticated users.
    Route::middleware('auth:api')->group(function () {
        // Get user info
        Route::get('user', 'AuthController@user');
        // Logout user from application
        Route::post('logout', 'AuthController@logout');
    });
});

Route::middleware('auth:api')->get('/user', function () {
    return request()->user();
});

// Route::middleware('client_credentials')->get('/user', function () {
//     return response()->json(["data" => true]);
// });

// Route::middleware('client_credentials')->get('/user/get', function () {
//     $user_id = request()->get("uid");
//     $user = App\User::where('id', '=', $user_id)->get()->first();
//     return response()->json($user);
// });
