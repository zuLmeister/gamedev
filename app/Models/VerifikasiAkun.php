<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiAkun extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','token'];
    protected $guarded = [];

    public function user(){
        return $this->hasOne(User::class, 'user_id');
    }
}
