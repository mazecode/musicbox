<?php

/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function () {
    return request()->user();
});

use App\User;
use Illuminate\Http\Request;

Route::middleware('client_credentials')->get('/user', function (Request $request) {
    return response()->json(["data" => true]);
});

Route::middleware('client_credentials')->get('/user/get', function (Request $request) {
    $user_id = $request->get("uid");
    $user = User::where('id', '=', $user_id)->get()->first();
    return response()->json($user);
});
