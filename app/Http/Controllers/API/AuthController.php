<?php

namespace App\Http\Controllers\API;

use App\Actions\User\LoginUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle user login
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $user = (new LoginUser)
            ->setRequest($request)
            ->execute();

        if ($user instanceof User) {
            return response()->json(['access_token' => $user->generateToken()], 200);
        }

        return response()->json(['message' => 'Invalid Username or Password'], 401);
    }

    /**
     * Handle user logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if (Auth::user()->tokens()->first()->delete())
        {
            return response()->json(['success' => true], 204);
        }
    }
}
