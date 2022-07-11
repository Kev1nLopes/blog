<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {

    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        
        $credentials = $request->only('email', 'password');
        if(!auth()->attempt($credentials))
            response()->json(['error' => 'Credenciais invalidas'], 422);

        $token = auth()->user()->createToken('TokenSanctum');

        return response()->json([
            'data'=>[
                'token' => $token->plainTextToken,
                'user' => $user
            ]
        ]);
    }

    public function logout()
    {
        //deleta o token da requisicao atual
        auth()->user()->currentAccessToken()->delete();
    }
}
