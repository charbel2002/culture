<?php

namespace App\Http\Controllers;

use App\Models\Atelier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AtelierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ateliers = Atelier::all();
        return view('dashboard.atelier.manage',compact('ateliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.atelier.create');
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
            'name' => 'required',
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

            Atelier::create([
                'name' => $request->name,
                'media' => 'uploads/rythm/' . $name,
                'description' => $request->description
            ]);

            notify()->success(ATELIER_CREATED);

            return redirect()->route('atelier.index');

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
    public function edit(Atelier $atelier)
    {
        return view('dashboard.atelier.edit',compact('atelier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atelier $atelier)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
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

                if($request->hasFile('media'))
                {

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

            $atelier->update([
                'name' => $request->name,
                'media' => $request->hasFile('media') ? 'uploads/atelier/' . $name : $atelier->media,
                'description' => $request->description
            ]);

            notify()->success(ATELIER_UPDATED);

            return redirect()->route('atelier.index');

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
    public function destroy(Atelier $atelier)
    {
        try {

            unlink(public_path($atelier->media));

            $atelier->delete();

            notify()->success(ATELIER_DELETED);

            return redirect()->back();

        } catch (\Throwable $th) {

            notify()->success($th->getMessage());

            return redirect()->back();

        }
    }
}
