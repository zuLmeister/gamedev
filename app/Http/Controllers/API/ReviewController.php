<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{

    public function show($game){
        $game = Review::where('game_id',$game)->get();

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
                'pesan' => 'Tidak ada komentar'
            ]);
        }

    }

    public function store(Request $request, $user_id, $game_id){
        $validator = Validator::make($request->all(), [
            'komentar'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $game = Review::create([
            'user_id' => $user_id,
            'game_id' => $game_id,
            'komentar' => $request->komentar,
        ]);

        
        if($game){
            return response()->json([
                'number' => 200,
                'status' => true,
                'pesan' => 'Komentar berhasil ditambahkan'
            ]);
        } else {
            return response()->json([
                'number' => 401,
                'status' => false,
                'pesan' => 'Komentar gagal ditambahkan',
            ]);
        }
       
    }

    public function update(Request $request, $user_id, $game_id){
        $validator = Validator::make($request->all(), [
            'nama'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $game = Review::where([['user_id','=',$user_id],
                        'game_id','=',$game_id]);
        
        $game = Kategori::update([
            'komentar' => $request->komentar,
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

    public function delete($user_id, $game_id){
        $game = Review::where([['user_id','=',$user_id],
                        'game_id','=',$game_id]);
        
        if($game->delete()){
            return response()->json([
                'number' => 200,
                'status' => true,
                'pesan' => 'Komentar berhasil dihapus'
            ]);
        } else {
            return response()->json([
                'number' => 401,
                'status' => true,
                'pesan' => 'Komentar gagal dihapus'
            ]);
        }
    }
}
