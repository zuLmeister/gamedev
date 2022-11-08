<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index(){
        $game = Kategori::when(request()->q, function($game) {
            $game = $game->where('nama', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);

        if($game){
            return response()->json([
                'number' => 200,
                'status' => true,
                'data' => $game,
            ]);
        } else {
            return response()->json([
                'number' => 401,
                'status' => false,
                'pesan' => 'Kategori tidak ditemukan'
            ]);
        }
    }

    public function show($id){
        $game = Kategori::FindOrFail($id)->first();

        if($game){
            return response()->json([
                'number' => 200,
                'status' => true,
                'data' => $game,
            ]);
        } else {
            return response()->json([
                'number' => 401,
                'status' => false,
                'pesan' => 'Kategori tidak ditemukan'
            ]);
        }

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $game = Kategori::create([
            'nama' => $request->nama,
            'slug' => Str::slug('nama'),
        ]);

        
        if($game){
            return response()->json([
                'number' => 200,
                'status' => true,
                'pesan' => 'Kategori berhasil ditambahkan'
            ]);
        } else {
            return response()->json([
                'number' => 401,
                'status' => false,
                'pesan' => 'Kategori gagal ditambahkan',
            ]);
        }
       
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nama'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $game = Kategori::FindOrFail($id);
        
        $game = Kategori::update([
            'nama' => $request->nama,
            'slug' => Str::slug('nama'),
        ]);


        if($game){
            return response()->json([
                'number' => 200,
                'status' => true,
                'pesan' => 'Kategori berhasil diubah'
            ]);
        } else {
            return response()->json([
                'number' => 401,
                'status' => false,
                'pesan' => 'Kategori gagal diubah',
            ]);
        }
    }

    public function delete($id){
        $game = Kategori::FindOrFail($id);
        
        if($game->delete()){
            return response()->json([
                'number' => 200,
                'status' => true,
                'pesan' => 'Kategori berhasil dihapus'
            ]);
        } else {
            return response()->json([
                'number' => 401,
                'status' => true,
                'pesan' => 'Kategori gagal dihapus'
            ]);
        }
    }
}
