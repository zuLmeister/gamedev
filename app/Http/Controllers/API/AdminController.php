<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function register(){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $admin = Admin::create([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if($admin){
            return response()->json([
                'number' => '200',
                'status' => True,
                'Pesan' => 'Admin berhasil ditambahkan'
            ], 200);

        } else {
            return response()->json([
                'number' => '401',
                'status' => false,
                'pesan' => 'Admin gagal ditambahkan'
            ]);
        }
        
    }
}
