<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $playlists = auth()->user()->playlists;
        return view('dashboard.playlist.manage',compact('playlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.playlist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        if($validator->fails())
        {

            $fields = $validator->getMessageBag()->keys();

            $message = count($fields) > 1 ? "les champs " . implode(',',input_array_scrawler($fields)) . " sont vides" : "le champ " . implode(',',input_array_scrawler($fields)) . " est vide";

            notify()->error($message);
            return redirect()->back();

        }

        try {

            $user = User::find(auth()->user()->id);

            $user->playlists()->create([
                'name' => $request->name
            ]);

            notify()->success(PLAYLIST_CREATED);

            return redirect()->route('playlist.index');

        } catch (\Throwable $th) {

            notify()->error($th->getMessage());

            return redirect()->back();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Playlist $playlist)
    {
        $musics = $playlist->music;
        return view('dashboard.playlist.show',compact('musics','playlist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Playlist $playlist)
    {
        return view('dashboard.playlist.edit',compact('playlist'));
    }

    public function consult_playlist(Request $request)
    {

        try {

            $user = User::find(auth()->user()->id);

            $user->playlist_consult()->create([
                'playlist_id' => $request->playlist_id
            ]);

            return json_encode([
                'code' => 200,
                'text' => ''
            ]);

        } catch (\Throwable $th) {

            return json_encode([
                'code' => 400,
                'text' => $th->getMessage()
            ]);
        }

    }

    public function explore($playlist)
    {

        $thePlaylist = Playlist::find($playlist);

        $musics = $thePlaylist->music;

        return view('dashboard.common_playlist',compact('musics','thePlaylist'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Playlist $playlist)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        if($validator->fails())
        {

            $fields = $validator->getMessageBag()->keys();

            $message = count($fields) > 1 ? "les champs " . implode(',',input_array_scrawler($fields)) . " sont vides" : "le champ " . implode(',',input_array_scrawler($fields)) . " est vide";

            notify()->error($message);
            return redirect()->back();

        }

        try {

            $playlist->update([
                'name' => $request->name
            ]);

            notify()->success(PLAYLIST_UPDATED);

            return redirect()->route('playlist.index');

        } catch (\Throwable $th) {

            notify()->error($th->getMessage());

            return redirect()->back();

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Playlist $playlist)
    {

        try {

            $playlist->music()->delete();

            $playlist->delete();

            notify()->success(PLAYLIST_DELETED);

            return redirect()->back();

        } catch (\Throwable $th) {

            notify()->success($th->getMessage());

            return redirect()->back();

        }

    }
}
