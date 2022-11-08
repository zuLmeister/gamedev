<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['game_id','user_id','komentar'];
    protected $guarded = [];

    public function user(){
        return $this->hasOne(User::class, 'user_id');
    }
}
