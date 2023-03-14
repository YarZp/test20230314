<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(UserStoreRequest $request):object
    {
        $data = $request->validated();
        $data['password']= Hash::make($data['password']);
        $user = User::create($data);
        $token = $user->createToken('create')->accessToken;
        $response = ['token' => $token];
        $cookie = cookie('jwt', $token, 3600);
        return response($response, 200);
    }
    public function login(LoginRequest $request):object
    {
        $data = $request->validated();
        if(auth()->attempt($data)){
            $user = auth()->user();
            $token = $user->createToken('create')->accessToken;
            $cookie = cookie('jwt', $token, 3600);

            return response()->json(['token' => $token, 'user'=>$user], 200)->withCookie($cookie);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    public function logout():object
    {
        $cookie = cookie()->forget('jwt');
        return response(['message'=>'success'], 200)->withCookie($cookie);
    }
}
