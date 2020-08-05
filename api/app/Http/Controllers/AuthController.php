<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function authenticate(UserLogin $request)
    {
        $data = $request->validated();

        if(!Auth::attempt($data)) {
            return response(['message' => 'Invalid login details']);
        }

        $user = Auth::user();

        $accessToken = $user->createToken('authToken')->plainTextToken;

        return $this->respondWithSuccess(['access_token' => $accessToken], 'user authenticated successfully', 200);

    }
}