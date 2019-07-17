<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Response;
use App\Role;
use App\Permission;
use App\Http\Resources\PermissionResource;

class AuthController extends Controller
{
    /**
     * Index
     *
     * @return void
     */
    public function index()
    {
        return response()->json(['auth' => auth()->user(), 'users' => User::all()]);
    }

    /**
     * Register a new user
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        $v = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return abort(401);
        }

        return (new UserResource($user))
            ->additional([
                'meta' => [
                    'token' => $token
                ]
            ]);
    }

    /**
     * Login user and return a token
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'errors' => [
                    'email' => ['There is something wrong! We could not verify details']
                ]
            ], 422);
        }

        return (new UserResource($request->user()))
            ->additional([
                'meta' => [
                    'token' => $token
                ]
            ])
            ->response()
            ->header('Authorization', $token);
    }

    /**
     * Refresh JWT token
     */
    public function refresh()
    {
        if (!$token = auth()->refresh()) {
            return response()->json(['error' => 'refresh_token_error'], 401);
        }

        return response()
            ->json([
                'meta' => [
                    'token' => $token
                ],
                'status' => 'Success'
            ], Response::HTTP_OK)
            ->header('Authorization', $token);
    }

    /**
     * Logout User
     */
    public function logout()
    {
        auth()->logout();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Logged out Successfully.'
        // ], 200);
    }

    /**
     * Get authenticated user
     *
     * @param Request $request
     * @return void
     */
    public function user(Request $request)
    {
        return new UserResource($request->user());
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function createRole(Request $request)
    {
        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        return (new RoleResource($role))
            ->additional(
                [
                    'message' => 'Role created'
                ]
            )
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function createPermission(Request $request)
    {
        $viewUsers = new Permission();
        $viewUsers->name = $request->input('name');
        $viewUsers->save();

        return (new PermissionResource($viewUsers))
            ->additional(
                [
                    'message' => 'Permission created'
                ]
            )
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function assignRole(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        $role = Role::where('name', $request->input('role'))->first();
        //$user->attachRole($request->input('role'));
        $user->roles()->attach($role->id);

        return response()->json("Role assignaded", Response::HTTP_OK);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function attachPermission(Request $request)
    {
        $role = Role::where('name', $request->input('role'))->first();
        $permission = Permission::where('name', $request->input('name'))->first();
        $role->attachPermission($permission);

        return response()->json("Permission attached", Response::HTTP_OK);
    }
}
