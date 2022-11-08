<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class EditProfilController extends Controller
{
    public function update(Request $request, User $user){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->password){
            if ($request->file('profil')) {

                //remove old image
                if ($user->profil){
                    Storage::disk('local')->delete('public/profil/'.basename($user->profil));
                }

                //upload new image
                $image = $request->file('profil');
                $image->storeAs('public/profil', $image->hashName());
    
                $user->update([
                    'username' => $request->username,
                    'password' => $request->password,
                    'profil' => $profil->hashName(),
                ]);

                if($user){
                    return response()->json([
                        'number' => 200,
                        'success' => True,
                        'pesan' => 'Edit profil berhasil'
                    ]);
                } else {
                    return response()->json([
                        'number' => 401,
                        'success' => false,
                        'pesan' => 'Edit profil gagal'
                    ]);
                }

    
            } else {
                $user->update([
                    'username' => $request->username,
                    'password' => $request->password,
                ]);

                if($user){
                    return response()->json([
                        'number' => 200,
                        'success' => True,
                        'pesan' => 'Edit profil berhasil'
                    ]);
                } else {
                    return response()->json([
                        'number' => 401,
                        'success' => false,
                        'pesan' => 'Edit profil gagal'
                    ]);
                }
            }
        } else {
            if ($request->file('profil')) {

                //remove old image
                if ($user->profil){
                    Storage::disk('local')->delete('public/profil/'.basename($user->profil));
                }

                //upload new image
                $image = $request->file('profil');
                $image->storeAs('public/profil', $image->hashName());
    
                $user->update([
                    'username' => $request->username,
                    'profil' => $profil->hashName(),
                ]);

                if($user){
                    return response()->json([
                        'number' => 200,
                        'success' => True,
                        'pesan' => 'Edit profil berhasil'
                    ]);
                } else {
                    return response()->json([
                        'number' => 401,
                        'success' => false,
                        'pesan' => 'Edit profil gagal'
                    ]);
                }

            } else {
                $user->update([
                    'username' => $request->username,
                ]);

                if($user){
                    return response()->json([
                        'number' => 200,
                        'success' => True,
                        'pesan' => 'Edit profil berhasil'
                    ]);
                } else {
                    return response()->json([
                        'number' => 401,
                        'success' => false,
                        'pesan' => 'Edit profil gagal'
                    ]);
                }
            }
    
        }
        
    }
}
