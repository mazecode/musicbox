<?php

Route::get('/hello', function() {
	return response()->json('Hello World', 200);
});

Route::middleware('auth:api')->get('/user', function () {
    return request()->user();
});

Route::middleware('client_credentials')->get('/user', function () {
    return response()->json(["data" => true]);
});

Route::middleware('client_credentials')->get('/user/get', function () {
    $user_id = request()->get("uid");
    $user = App\User::where('id', '=', $user_id)->get()->first();
    return response()->json($user);
});
