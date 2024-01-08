<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }

        $cridentials = $request->only('username', 'password');

        if(!Auth::attempt($cridentials)){
            $user = User::where('username', $request['username'])->first();

            $errorMessage = $user ? 'Password Salah' : 'Username tidak terdaftar';

            return response()->json(['message' => $errorMessage], 422);
        }

        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token], 201);
    }
    public function unauthorized()
    {
        return response()->json(['message' => 'unauthorized']);
    }
}
