<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResetPassword;
use App\Models\User;


class LinkLupaPassword extends Controller
{
    public function postemail(Request $request){
        $validator = Validator::make($request->all(), [
            'email'  => 'required|email',
        ]);
        $email = $request->email;
        $data = User::where('email',$email)->first();

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if(is_null($data)){
            return response()->json([
                'number' => 400,
                'status' => False,
                'pesan' => 'Email tidak ditemukan'
            ]);
        } else {

            $token = Str::random(6);

            ResetPassword::create([
                'email' => $email,
                'token' => $token,
                'expired' => 0,
            ]);

            Mail::send('email.email_reset_password', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password Akun GameRev');
            });

            return response()->json([
                'number' => 200,
                'status' => True,
                'pesan' => 'Silahkan check e-mail mu'
            ]);

        }
    }
}
