<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $musics = $user->music;
        return view('dashboard.music.show',compact('musics'));
    }

    public function download_music($music_id)
    {

        $music = Music::find($music_id);

        return response()->download(public_path($music->media));

    }

    public function play_music(Request $request)
    {

        try {

            $user = User::find(auth()->user()->id);

            $user->music_read()->create([
                'music_id' => $request->music_id
            ]);

            return json_encode([
                'code' => 200,
                'text' => 'Error'
            ]);

        } catch (\Throwable $th) {

            return json_encode([
                'code' => 400,
                'text' => $th->getMessage()
            ]);
        }

    }

    public function download_action(Request $request)
    {

        try {

            $user = User::find(auth()->user()->id);

            $user->music_download()->create([
                'music_id' => $request->music_id
            ]);

            return json_encode([
                'code' => 200,
                'text' => 'Error'
            ]);

        } catch (\Throwable $th) {

            return json_encode([
                'code' => 400,
                'text' => $th->getMessage()
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $playlist = Playlist::find($request->playlist);
        return view('dashboard.music.create',compact('playlist'));
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
            'title' => 'required',
            'playlist_id' => 'required'
        ]);

        if($validator->fails())
        {

            $fields = $validator->getMessageBag()->keys();

            $message = count($fields) > 1 ? "les champs " . implode(',',input_array_scrawler($fields)) . " sont vides" : "le champ " . implode(',',input_array_scrawler($fields)) . " est vide";

            notify()->error($message);
            return redirect()->back();

        }

        try {

            $playlist = Playlist::find($request->playlist_id);

            $name = null;

            if (!$request->has('media')) {

                notify()->error(MUSIC_REQUIRED);

                return redirect()->back();

            }

            try {

                $media = $request->file('media');

                $_name = $media->getClientOriginalName();

                $ext = $media->getClientOriginalExtension();

                $name = md5($_name . now()) . '.' . $ext;

                $media->move(public_path('uploads/music/'),$name);

            } catch (\Throwable $th) {

                notify()->error($th->getMessage());

                return redirect()->back();

            }

            $playlist->music()->create([
                'title' => $request->title,
                'media' => 'uploads/music/' . $name
            ]);

            notify()->success(MUSIC_CREATED);

            return redirect()->route('playlist.show',['playlist' => $playlist->id]);

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
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Music $music)
    {
        $playlist = $music->playlist;
        return view('dashboard.music.edit',compact('music','playlist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Music $music)
    {

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'playlist_id' => 'required'
        ]);

        if($validator->fails())
        {

            $fields = $validator->getMessageBag()->keys();

            $message = count($fields) > 1 ? "les champs " . implode(',',input_array_scrawler($fields)) . " sont vides" : "le champ " . implode(',',input_array_scrawler($fields)) . " est vide";

            notify()->error($message);
            return redirect()->back();

        }

        try {

            $playlist = Playlist::find($request->playlist_id);

            $name = null;

            try {

                if($request->hasFile('media'))
                {

                    $media = $request->file('media');

                    $_name = $media->getClientOriginalName();

                    $ext = $media->getClientOriginalExtension();

                    $name = md5($_name . now()) . '.' . $ext;

                    $media->move(public_path('uploads/music/'),$name);

                }

            } catch (\Throwable $th) {

                notify()->error($th->getMessage());

                return redirect()->back();

            }

            $music->update([
                'title' => $request->title,
                'media' => $request->hasFile('media') ? 'uploads/music/' . $name : $music->media
            ]);

            notify()->success(MUSIC_UPDATED);

            return redirect()->route('playlist.show',['playlist' => $music->playlist->id]);

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
    public function destroy(Music $music)
    {

        try {

            unlink(public_path($music->media));

            $music->delete();

            notify()->success(MUSIC_DELETED);

            return redirect()->back();

        } catch (\Throwable $th) {

            notify()->success($th->getMessage());

            return redirect()->back();

        }

    }
}
