<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriGame extends Model
{
    use HasFactory;
    protected $fillable = ['game_id','kategori_id'];
    protected $guarded = [];

    public function kategori_game(){
        return $this->hasMany(KategoriGame::class, 'kategori_id');
    }

}
