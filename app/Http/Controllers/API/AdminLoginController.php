<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function index(Request $request)
    {
        //set validasi
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        //response error validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        $credentials = $request->only('username', 'password');

        //check jika "email" dan "password" tidak sesuai
        if(!$token = auth()->guard('api_admin')->attempt($credentials)) {

            //response login "failed"
            return response()->json([
                'number' => 401,
                'success' => false,
                'pesan' => 'Maaf, ID atau password salah'
            ], 401);

        }

        //response login "success" dengan generate "Token"
        return response()->json([
            'number' => 200,
            'success' => 'Berhasil',
            'user'    => auth()->guard('api_admin')->user(),
            'token'   => $token
        ], 200);
    }
}
