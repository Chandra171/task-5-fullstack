<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'Registrasi Berhasil'
        ],201);
    }

    public function login(Request $request){

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json([
                'status'=> false,
                'message' => 'Email atau Password Invalid',
            ], 400);
        }
        
        $token = Auth::user()->createToken('authToken')->accessToken;
        return response()->json([
            'status' => true,
            'message' => 'Login Berhasil',
            'user' => Auth::user(),
            'token' => $token
        ], 200);
    }

    public function profile(){
        
        return response()->json([
            'status'=>true,
            'message'=> 'Cek Pengguna',
            'user'=> Auth::user()
        ],200);
    }

    public function logout(Request $request){

        $token = $request->user()->token();
        $token->revoke();

        return response()->json([
            'status'=>true,
            'message'=>'Anda berhasil Logout'
        ], 200);
    }
}
