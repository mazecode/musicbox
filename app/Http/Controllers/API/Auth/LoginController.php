<?php


namespace App\Http\Controllers\API\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $data = $request->all();
        $errors = [];
        $data = [];
        $message = "";
        $status = true;
        $validator = Validator::make($data, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $status = false;
            $errors = $validator->errors();
            $message = "Login Failed";
        }
        $credentials = $request->only("email", "password");
        if (!$token = auth('api')->attempt($credentials)) {
            $status = false;
            $errors = [
                "login" => "Invalid username or password",
            ];
            $message = "Login Failed";
        } else {
            $message = "Login Successfull";
            $data = [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
            ];
        }
        return $this->sendResult($message, $data, $errors, $status);
    }

    protected function sendResult($message, $data, $errors = [], $status = true)
    {
        $errorCode = $status ? 200 : 422;
        $result = [
            "message" => $message,
            "status" => $status,
            "data" => $data,
            "errors" => $errors,
        ];
        return response()->json($result, $errorCode);
    }
}

// https://www.cloudways.com/blog/laravel-jwt-authentication/
// https://medium.com/@codebyjeff/simple-jwtoken-acl-for-laravel-ae82d462c632
