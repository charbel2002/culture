<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistConsult extends Model
{
    use HasFactory;

    protected $fillable = ['id','playlist_id','user_id'];

}
