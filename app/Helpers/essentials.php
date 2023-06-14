<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

if(!function_exists('getUser'))
{
    function getUser()
    {
        return Auth::user();
    }
}

if(!function_exists('getUserRole'))
{
    function getUserRole()
    {

        $user = User::find(auth()->user()->id);

        return $user->role;
    }
}

if(!function_exists('getProfile'))
{
    function getProfile()
    {

        $user = User::find(auth()->user()->id);

        return $user->profile;
    }
}

if(!function_exists('formatSizeUnits'))
{
    function formatSizeUnits($bytes)
    {

        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } elseif ($bytes == 1) {
            return $bytes . ' byte';
        } else {
            return '0 bytes';
        }

    }
}

if(!function_exists('count_music_read'))
{
    function count_music_read()
    {

        $user = User::find(auth()->user()->id);

        $playlists =  $user->playlists;

        $reads = 0;

        foreach ($playlists as $playlist) {

            $musics = $playlist->music;

            foreach ($musics as $music) {
                $reads += $music->read->count();
            }

        }

        return $reads;

    }
}

if(!function_exists('count_playlist_consult'))
{
    function count_playlist_consult()
    {

        $user = User::find(auth()->user()->id);

        $playlists =  $user->playlists;

        $consults = 0;

        foreach ($playlists as $playlist) {

            $consults += $playlist->consult->count();

        }

        return $consults;

    }
}

if(!function_exists('count_music_download'))
{
    function count_music_download()
    {

        $user = User::find(auth()->user()->id);

        $playlists =  $user->playlists;

        $downloads = 0;

        foreach ($playlists as $playlist) {

            $musics = $playlist->music;

            foreach ($musics as $music) {
                $downloads += $music->downloads->count();
            }

        }

        return $downloads;

    }
}
