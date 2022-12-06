<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\VerifikasiAkun;
use Mail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //set validasi
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        //response error validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        $credentials = $request->only('email', 'password');

        //check jika "email" dan "password" tidak sesuai
        if(!$token = auth()->guard('api_guest')->attempt($credentials)) {

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
            'token'   => $token
        ], 200);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            // 'username' => 'required',
            'password' => 'required|min:8',
            // 'profil' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // $profil = $request->hasFile('profil');
        // $profil->storeAs('public/akun', $profil->hashName());

        $User = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        


        if($User){
        //     $token = Str::random(6);

        //     VerifikasiAkun::create([
        //         'user_id' => $User->id,
        //         'token' => $token
        //     ]);

        //     Mail::send('email.email_reset_password', ['token' => $token], function($message) use($request){
        //         $message->to($request->email);
        //         $message->subject('Verifikasi Akun GameRev');
        //     });

            $credentials = $request->only('email', 'password');

            //check jika "email" dan "password" tidak sesuai
            if(!$token = auth()->guard('api_guest')->attempt($credentials)) {

                //response login "failed"
                return response()->json([
                    'number' => 401,
                    'success' => false,
                    'pesan' => 'Maaf, ID atau password salah'
                ], 401);

            } else {
                return response()->json([
                    'number' => 200,
                    'success' => 'Berhasil',
                    'token'   => $token
                ], 200);
            }

        } else {
            return response()->json([
                'number' => '401',
                'status' => false,
                'pesan' => 'User gagal ditambahkan'
            ], 401);
        }
        
    }

    public function logout(){
        auth()->logout();

        return response()->json([
            'success' => true,
        ], 200);
    }

    public function me(){
        return response()->json([
            'success' => true,
            'data' => auth()->guard('api_guest')->user(),
        ], 200);
    }
}
