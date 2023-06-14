<?php

namespace App\Http\Controllers;

use App\Models\Rythm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RythmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rythms = Rythm::all();
        return view('dashboard.rythm.manage',compact('rythms'));
    }

    public function download_rythm($rythm_id)
    {
        $rythm = Rythm::find($rythm_id);

        return response()->download(public_path($rythm->media));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.rythm.create');
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
            'description' => 'required'
        ]);

        if($validator->fails())
        {

            $fields = $validator->getMessageBag()->keys();

            $message = count($fields) > 1 ? "les champs " . implode(',',input_array_scrawler($fields)) . " sont vides" : "le champ " . implode(',',input_array_scrawler($fields)) . " est vide";

            notify()->error($message);
            return redirect()->back();

        }

        try {

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

                $media->move(public_path('uploads/rythm/'),$name);

            } catch (\Throwable $th) {

                notify()->error($th->getMessage());

                return redirect()->back();

            }

            Rythm::create([
                'title' => $request->title,
                'media' => 'uploads/rythm/' . $name,
                'description' => $request->description
            ]);

            notify()->success(RYTHM_CREATED);

            return redirect()->route('rythm.index');

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Rythm $rythm)
    {
        return view('dashboard.rythm.edit',compact('rythm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rythm $rythm)
    {

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails())
        {

            $fields = $validator->getMessageBag()->keys();

            $message = count($fields) > 1 ? "les champs " . implode(',',input_array_scrawler($fields)) . " sont vides" : "le champ " . implode(',',input_array_scrawler($fields)) . " est vide";

            notify()->error($message);
            return redirect()->back();

        }

        try {

            $name = null;

            try {

                if ($request->hasFile('media')) {

                    $media = $request->file('media');

                    $_name = $media->getClientOriginalName();

                    $ext = $media->getClientOriginalExtension();

                    $name = md5($_name . now()) . '.' . $ext;

                    $media->move(public_path('uploads/rythm/'),$name);

                }

            } catch (\Throwable $th) {

                notify()->error($th->getMessage());

                return redirect()->back();

            }

            $rythm->update([
                'title' => $request->title,
                'media' => $request->hasFile('media') ? 'uploads/rythm/' . $name : $rythm->media,
                'description' => $request->description
            ]);

            notify()->success(RYTHM_UPDATED);

            return redirect()->route('rythm.index');

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
    public function destroy(Rythm $rythm)
    {
        try {

            unlink(public_path($rythm->media));

            $rythm->delete();

            notify()->success(RYTHM_DELETED);

            return redirect()->back();

        } catch (\Throwable $th) {

            notify()->success($th->getMessage());

            return redirect()->back();

        }
    }
}
