<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $fillable = ['id','title','media'];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class,'playlist_id');
    }

    public function read()
    {
        return $this->hasMany(MusicRead::class);
    }

    public function downloads()
    {
        return $this->hasMany(MusicDownload::class);
    }

}
