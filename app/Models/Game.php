<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $fillable = ['nama','deskripsi','cover','video','rekomendasi','slug'];
    protected $guarded = [];

    public function slider(){
        return $this->hasMany(Slider::class, 'game_id','id');
    }

    public function kategori(){
        return $this->hasOne(Kategori::class, 'game_id','id');
    }

}
