<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            return response()->json(['error' => 'Usuário não cadastrado!'], 401);
        }
        
        if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Senha incorreta!'], 401);
        }
        
        return response()->json($user);
    }

}
