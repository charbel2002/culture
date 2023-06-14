<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth')->except('store');
    }

    public function index()
    {

        $users = User::all();
        return view('dashboard.user.manage',compact('users'));

    }

    public function show()
    {

    }

    public function create()
    {

        $roles = Role::all();
        return view('dashboard.user.create',compact('roles'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails())
        {

            $fields = $validator->getMessageBag()->keys();

            $message = count($fields) > 1 ? "les champs " . implode(',',input_array_scrawler($fields)) . " sont vides" : "le champ " . implode(',',input_array_scrawler($fields)) . " est vide";

            notify()->error($message);
            return redirect()->back();

        }

        try {

            $user = new User;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            if($user->save())
            {

                notify()->success(USER_CREATED);

                return redirect()->back();

            }
            else{

                notify()->error(USER_OP_ERR);

                return redirect()->back();

            }

        } catch (\Throwable $th) {

            notify()->error($th->getMessage());

            return redirect()->back();

        }

    }

    public function edit(User $user)
    {

        return view('dashboard.user.edit')->with([
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    public function set_profile(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'c_name' => 'required',
            'role_id' => 'required'
        ]);

        if($validator->fails())
        {

            $fields = $validator->getMessageBag()->keys();

            $message = count($fields) > 1 ? "les champs " . implode(',',input_array_scrawler($fields)) . " sont vides" : "le champ " . implode(',',input_array_scrawler($fields)) . " est vide";

            notify()->error($message);
            return redirect()->back();

        }

        try {

            if($request->role_id == 2)
            {
                if(!$request->has('bio'))
                {
                    notify()->error('En tant d\'artiste, vous devez rensigner votre biographie');

                    return redirect()->back();
                }
            }

            // First i upload the pic

            $media = $request->file('pic');

            $o_name = $media->getClientOriginalName();

            $ext = $media->getClientOriginalExtension();

            $name = md5($o_name . now()) . '.' . $ext;

            $media->move(public_path('uploads/profile/'),$name);

            $user = User::find(auth()->user()->id);

            $user->user_role()->create([
                'role_id' => $request->role_id
            ]);

            $profile = Profile::create([
                'c_name' => $request->c_name,
                'pic' => 'uploads/profile/' . $name,
                'user_id' => auth()->user()->id
            ]);

            if($request->has('bio') || $request->bio == null)
            {
                $profile->bio()->create([
                    'content' => $request->bio
                ]);
            }

            notify()->success('Profile complété avec succès');

            return redirect()->back();

        } catch (\Throwable $th) {

            notify()->error($th->getMessage());

            return redirect()->back();

        }

    }

    public function update(Request $request, User $user)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required'
        ]);

        if($validator->fails())
        {

            $fields = $validator->getMessageBag()->keys();

            $message = count($fields) > 1 ? "les champs " . implode(',',input_array_scrawler($fields)) . " sont vides" : "le champ " . implode(',',input_array_scrawler($fields)) . " est vide";

            notify()->error($message);
            return redirect()->back();

        }

        try {

            if($request->has('reset_password'))
            {

                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);

                $user->user_role->update(['role_id' => $request->role_id]);

            }
            else{

                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

                $user->user_role->update(['role_id' => $request->role_id]);

            }

            notify()->success(USER_UPDATED);

            return redirect()->back();

        } catch (\Throwable $th) {

            notify()->success($th->getMessage());

            return redirect()->back();

        }

    }

    public function delete(User $user)
    {

        try {

            $user->delete();

            notify()->success(USER_DELETED);

            return redirect()->back();

        } catch (\Throwable $th) {

            notify()->success($th->getMessage());

            return redirect()->back();

        }

    }

}
