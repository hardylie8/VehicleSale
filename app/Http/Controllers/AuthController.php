<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * login and get JWT Token
     * @param \App\Http\Requests\loginRequest $request
     *
     * @return JsonResponse
     */
    public function login(loginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'success' => 'error',
                'message' => 'Unauthorized/wrong password or id',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'success' => true,
            'message' => "login is succesful",
            'data' => [
                'user' => $user,
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);

    }

    /**
     * Register a new user and get JWT Token
     * @param \App\Http\Requests\registerRequest $request
     *
     * @return JsonResponse
     */
    public function register(registerRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'success' => 'success',
            'message' => 'User created successfully',
            'data' => [
                'user' => $user,
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

    /**
     *log out and invalidate jwt token
     *
     * @return JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'success' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    /**
     * refresh the jwt token
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return response()->json([
            'success' => 'success',
            "message" => "token refresh success",
            'data' => [
                'user' => Auth::user(),
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ],
        ]);
    }
}
