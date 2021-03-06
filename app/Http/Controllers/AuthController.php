<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', ['except'=>['login', 'register']]);
    }

    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422); 
        }
        if(! $token = auth()->attempt($validator->validated())) { 
            return response()->json(['error' => 'Either email or password is wrong.'], 401);
        }

        return $this->createNewToken($token);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:30',
            'email' => 'required|string|email|max:100|unique:users',
            'role' => 'required|string',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
             return response()->json($validator->errors(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function userProfile() {
        return response()->json(auth()->user());
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'estado'=> true,
            'user' => auth()->user()
        ]);
    }
}
