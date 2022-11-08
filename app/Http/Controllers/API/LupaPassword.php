<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResetPassword;
use App\Models\User;

class LupaPassword extends Controller
{
    public function update(Request $request, $token)
    {
        $verifyUser = ResetPassword::where('token', $token)->first();
        $email = User::where('email',$verifyUser->email)->first();
        if(!$verifyUser){
            return response()->json([
                'number' => 400,
                'status' => False,
                'pesan' => 'Token yang dimasukkan tidak ditemukan'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $email->password = Hash::make($request->password);
            $email->save();

            $verifyUser->expired = 1;
            $verifyUser->save();

            return response()->json([
                'number' => 200,
                'status' => True,
                'pesan' => 'Password berhasil dirubah'
            ]);
        }
        
    }
}
