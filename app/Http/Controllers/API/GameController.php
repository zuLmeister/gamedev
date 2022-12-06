<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function index(){
        $game = Game::when(request()->q, function($game) {
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
                'pesan' => 'Game tidak ditemukan'
            ]);
        }
    }

    public function show($id){
        $game = Game::FindOrFail($id)->first();

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
                'pesan' => 'Game tidak ditemukan'
            ]);
        }

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama'  => 'required|unique:game',
            'deskripsi' => 'required|min:30',
            'cover' => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'rekomendasi' => 'required',
            'kategori' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        $cover = $request->file('cover');
        $new_cover = time() . $cover->getClientOriginalName();
        $cover->move('game/', $new_cover);

        $game = Game::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'cover' => public_path().'/game/'. $new_cover,
            'rekomendasi' => $request->rekomendasi,
            'slug' => Str::slug($request->nama),
        ]);

        if($game){
            return response()->json([
                'number' => 200,
                'status' => true,
                'pesan' => 'Game berhasil ditambahkan'
            ]);
        } else {
            return response()->json([
                'number' => 401,
                'status' => false,
                'pesan' => 'Game gagal ditambahkan',
            ]);
        }
       
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nama'  => 'unique:game',
            'deskripsi' => 'min:30',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $game = Game::FindOrFail($id);

        if ($request->hasFile('cover')) {

            //remove old image
            if ($game->cover){
                unlink($game->cover);
            }

            //upload new image
            $cover = $request->file('cover');
            $new_cover = time() . $cover->getClientOriginalName();
            $cover->move('cover/', $new_cover);

            $game->update([
                'nama' => $request->nama,
                'deskirpsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'cover' => public_path().'/game/'.$new_cover,
                'rekomendasi' => $request->rekomendasi,
                'slug' => Str::slug($request->nama),
            ]);

            if($game){
                return response()->json([
                    'number' => 200,
                    'success' => True,
                    'pesan' => 'Edit game berhasil'
                ]);
            } else {
                return response()->json([
                    'number' => 401,
                    'success' => false,
                    'pesan' => 'Edit game gagal'
                ]);
            }
        } else {
            $game->update([
                'nama' => $request->nama,
                'deskirpsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'rekomendasi' => $request->rekomendasi,
                'slug' => Str::slug($request->nama),
            ]);

            if($game){
                return response()->json([
                    'number' => 200,
                    'success' => True,
                    'pesan' => 'Edit game berhasil'
                ]);
            } else {
                return response()->json([
                    'number' => 401,
                    'success' => false,
                    'pesan' => 'Edit game gagal'
                ]);
            }
        }
    }

    public function delete($id){
        $game = Game::FindOrFail($id);
        
        if($game->delete()){
            unlink(public_path($game->cover));
            return response()->json([
                'number' => 200,
                'status' => true,
                'pesan' => 'Game berhasil dihapus'
            ]);
        } else {
            return response()->json([
                'number' => 401,
                'status' => true,
                'pesan' => 'Game gagal dihapus'
            ]);
        }
    }
}
