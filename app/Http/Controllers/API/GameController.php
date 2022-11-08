<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function index(){
        $game = Game::with('kategori.kategori_game','slider')->when(request()->q, function($game) {
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
        $game = Game::with('kategori.kategori_game','slider')->FindOrFail($id)->first();

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
            'nama'  => 'required',
            'deskripsi' => 'required',
            'cover' => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'video' => 'required',
            'rekomendasi' => 'required',
            'kategori_id' => 'required',
            'slider' => 'required|image|mimes:jpeg,jpg,png|max:2000'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        $image = $request->file('cover');
        $image->storeAs('public/game', $image->hashName());

        $video = $request->file('video');
        $video->storeAs('public/game', $video->hashName());

        $game = Game::create([
            'nama' => $request->nama,
            'deskirpsi' => $request->deskripsi,
            'cover' => $image->hashName(),
            'video' => $videp->hasName(),
            'rekomendasi' => $request->rekomendasi,
            'slug' => Str::slug('nama'),
        ]);

        if($request->kategori_id){
            foreach($request->kategori_id as $kategori){
                KategoriGame::create([
                    'game_id' => $game->id,
                    'kategori_id' => $request->kategori_id
                ]);
            }
        }

        if($request->has('gambar')){
            foreach($request->file('gambar') as $gambar){
                $gambar = $request->file('gambar');
                $gambar->storeAs('public/game/slider', $gambar->hashName());
                Slider::create([
                    'id_paket' => $paket->id,
                    'gambar' => $slider->hashName(), 
                ]);
            }
        }

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
            'nama'  => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $game = Game::FindOrFail($id);
        
        if($request->file('video')){
            if($request->file('cover')){
                Storage::disk('local')->delete('public/game/'.basename($game->cover));
                Storage::disk('local')->delete('public/game/'.basename($game->video));

                $image = $request->file('cover');
                $image->storeAs('public/game', $image->hashName());

                $video = $request->file('video');
                $video->storeAs('public/game', $video->hashName());

                $game = Game::update([
                    'nama' => $request->nama,
                    'deskirpsi' => $request->deskripsi,
                    'cover' => $image->hashName(),
                    'video' => $videp->hasName(),
                    'rekomendasi' => $request->rekomendasi,
                    'slug' => Str::slug('nama'),
                ]);
            } else {
                Storage::disk('local')->delete('public/game/'.basename($game->video));

                $video = $request->file('video');
                $video->storeAs('public/game', $video->hashName());

                $game = Game::update([
                    'nama' => $request->nama,
                    'deskirpsi' => $request->deskripsi,
                    'video' => $videp->hasName(),
                    'rekomendasi' => $request->rekomendasi,
                    'slug' => Str::slug('nama'),
                ]);
            }

            if($request->kategori_id){
                $slider = KategoriGame::where('game_id',$game->$id)->get();
                foreach($slider as $sliders => $data){
                    $data->delete();
                }

                foreach($request->kategori_id as $kategori){
                    $request->method('POST');
                    KategoriGame::create([
                        'game_id' => $game->id,
                        'kategori_id' => $request->kategori_id
                    ]);
                }
            }
    
            if($request->has('gambar')){
                $slider = Slider::where('game_id',$game->$id)->get();
                foreach($slider as $sliders => $data){
                    unlink(public_path($data->gambar));
                    $data->delete();
                }

                foreach($request->file('gambar') as $gambar){
                    $request->method('POST');
                    $gambar = $request->file('gambar');
                    $gambar->storeAs('public/game/slider', $gambar->hashName());
                    Slider::create([
                        'game_id' => $paket->id,
                        'gambar' => $gambar->hashName(), 
                    ]);
                }
            }

            if($game){
                return response()->json([
                    'number' => 200,
                    'status' => true,
                    'pesan' => 'Game berhasil diubah'
                ]);
            } else {
                return response()->json([
                    'number' => 401,
                    'status' => false,
                    'pesan' => 'Game gagal diubah',
                ]);
            }

        } else {
            if($request->file('cover')){
                Storage::disk('local')->delete('public/game/'.basename($game->cover));

                $image = $request->file('cover');
                $image->storeAs('public/game', $image->hashName());

                $game = Game::update([
                    'nama' => $request->nama,
                    'deskirpsi' => $request->deskripsi,
                    'cover' => $image->hashName(),
                    'rekomendasi' => $request->rekomendasi,
                    'slug' => Str::slug('nama'),
                ]);
            } else {
                $game = Game::update([
                    'nama' => $request->nama,
                    'deskirpsi' => $request->deskripsi,
                    'rekomendasi' => $request->rekomendasi,
                    'slug' => Str::slug('nama'),
                ]);
            }

            if($request->kategori_id){
                $slider = KategoriGame::where('game_id',$game->$id)->get();
                foreach($slider as $sliders => $data){
                    $data->delete();
                }

                foreach($request->kategori_id as $kategori){
                    $request->method('POST');
                    KategoriGame::create([
                        'game_id' => $game->id,
                        'kategori_id' => $request->kategori_id
                    ]);
                }
            }
    
            if($request->has('gambar')){
                $slider = Slider::where('game_id',$game->$id)->get();
                foreach($slider as $sliders => $data){
                    unlink(public_path($data->gambar));
                    $data->delete();
                }

                foreach($request->file('gambar') as $gambar){
                    $request->method('POST');
                    $gambar = $request->file('gambar');
                    $gambar->storeAs('public/game/slider', $gambar->hashName());
                    Slider::create([
                        'game_id' => $paket->id,
                        'gambar' => $gambar->hashName(), 
                    ]);
                }
            }

            if($game){
                return response()->json([
                    'number' => 200,
                    'status' => true,
                    'pesan' => 'Game berhasil diubah'
                ]);
            } else {
                return response()->json([
                    'number' => 401,
                    'status' => false,
                    'pesan' => 'Game gagal diubah',
                ]);
            }
        }
    }

    public function delete($id){
        $game = Game::FindOrFail($id);
        
        if($game->delete()){
            Storage::disk('local')->delete('public/game/'.basename($game->cover));
            Storage::disk('local')->delete('public/game/'.basename($game->cover));
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
