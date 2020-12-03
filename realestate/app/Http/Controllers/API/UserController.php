<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserController extends Controller
{
    //
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'invalid creadentials'], 400);
        }
        return $this->createNewToken($token);
    }
    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(),400);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user','token'),201);
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'user successfully logged']);

    }
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }


}
