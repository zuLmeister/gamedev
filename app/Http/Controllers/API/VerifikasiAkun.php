<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifikasiAkun extends Controller
{
    public function verifyAccount($token)
    {
        $verifyUser = VerifikasiAkun::where('token', $token)->first();
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
            if(is_null($user->email_verified_at)){
                $verifyUser->user->email_verified_at = now();
                $verifyUser->user->save();
                return response()->json([
                    'number' => '200',
                    'status' => True,
                    'Pesan' => 'Akun telah terverifikasi'
                ], 200);

            } else {
                return response()->json([
                    'number' => '401',
                    'status' => True,
                    'Pesan' => 'Akun gagal terverifikasi'
                ], 401);
            }
        }
    }
}
