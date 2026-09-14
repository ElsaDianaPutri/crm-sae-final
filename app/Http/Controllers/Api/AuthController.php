<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate(['username'=>['required','string'],'password'=>['required','string']]);
        $user = User::where('username', $data['username'])->first();

        if (!$user || $user->status !== 'aktif' || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message'=>'Username/password salah atau akun tidak aktif.'], 401);
        }

        $token = $user->createToken('sae-cafe')->plainTextToken;
        return response()->json(['message'=>'Login berhasil','data'=>['token'=>$token,'role'=>$user->role,'username'=>$user->username]]);
    }

    public function logout(Request $request)
    {
        $request->user()?->currentAccessToken()?->delete();
        return response()->json(['message'=>'Logout berhasil']);
    }
}
