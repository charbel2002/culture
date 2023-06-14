<?php

namespace App\Http\Controllers;

use App\Models\Atelier;
use App\Models\Music;
use App\Models\Playlist;
use App\Models\Role;
use App\Models\Rythm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('no_profile');
    }

    public function index()
    {

        if(getUserRole()->id == 3)
        {
            return view('dashboard.common')->with([
                'latest_musics' => Music::latest()->take(10)->get(),
                'latest_playlists' => Playlist::latest()->take(10)->get(),
            ]);
        }
        else{
            return view('dashboard.index')->with([
                'count_playlists' => Playlist::count(),
                'count_musics' => Music::count(),
                'count_rythms' => Rythm::count(),
                'count_ateliers' => Atelier::count(),
                'count_roles' => Role::count(),
                'count_users' => User::count()
            ]);
        }

    }

    public function no_profile()
    {

        $user = User::find(auth()->user()->id);

        if($user->profile !== null)
        {
            return redirect()->route('dashboard.index');
        }

        $roles = Role::where('id','<>',1)->get();
        return view('dashboard.no_profile',compact('roles'));
    }

}
