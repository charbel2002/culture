<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = ['id','name'];

    public function music()
    {
        return $this->hasMany(Music::class);
    }

    public function artiste()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function consult()
    {
        return $this->hasMany(PlaylistConsult::class);
    }

}
