<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EditProfilController extends Controller
{
    public function show($id){
        $User = User::FindOrFail($id)->first();

        if($User){
            return response()->json([
                'number' => 200,
                'status' => true,
                'data' => $User,
            ]);
        } else {
            return response()->json([
                'number' => 401,
                'status' => false,
                'pesan' => 'User tidak ditemukan'
            ]);
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'username' => 'min:8',
            'email' => 'email',
            'password' => 'min:8',
            'profil' => 'mimes:jpeg,jpg,png,gif|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::FindOrFail($id);

        if ($request->password){
            if ($request->hasFile('profil')) {

                //remove old image
                if ($user->profil){
                    unlink($user->profil);
                }
    
                //upload new image
                $gambar = $request->file('profil');
                $new_gambar = time() . $gambar->getClientOriginalName();
                $gambar->move('profil/', $new_gambar);
    
                $user->update([
                    'username' => $request->username,
                    'email' => $request->email,
                    'profil' => public_path().'/profil/' . $new_gambar,
                    'password' => Hash::make($request->password),
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
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
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
            if ($request->hasFile('profil')) {

                //remove old image
                if ($user->profil){
                    unlink($user->profil);
                }
    
                //upload new image
                $gambar = $request->file('profil');
                $new_gambar = time() . $gambar->getClientOriginalName();
                $gambar->move('profil/', $new_gambar);
    
                $user->update([
                    'username' => $request->username,
                    'email' => $request->email,
                    'profil' => public_path().'/profil/'.$new_gambar,
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
                    'email' => $request->email,
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
