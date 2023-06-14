<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\Permission;
use App\Models\Resource;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RolesController extends Controller
{

    public function index()
    {

        $roles = Role::all();

        return view('dashboard.role.manage',compact('roles'));

    }

    public function show()
    {

    }

    public function create()
    {

        $resources = Resource::all();

        return view('dashboard.role.create',compact('resources'));

    }

    public function test()
    {

        $permissions = Permission::all();

        $operations = Operation::all();

        $resources = Resource::all();

        return view('test.role',compact('permissions','operations','resources'));

    }

    public function store(Request $request)
    {

        $create = [];
        $read = [];
        $update = [];
        $delete = [];

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

            $role = new Role;

            $role->name = $request->name;
            $role->slug = Str::slug($request->name);

            $role->save();

            // Registering role permissions

            $create = $request->has('create') ? $request->create : [];

            $read = $request->has('read') ? $request->read : [];

            $update = $request->has('update') ? $request->update : [];

            $delete = $request->has('delete') ? $request->delete : [];

            $permissions_id = [...$create,...$read,...$update,...$delete];

            foreach($permissions_id as $line)
            {

                // $role->role_permissions()->create(['permission_id' => $line]);

                $r_permissions = new RolePermission;

                $r_permissions->permission_id = $line;
                $r_permissions->role_id = $role->id;

                $r_permissions->save();

            }

            // $role->role_permissions->create($permissions_id);

            // End scope

            notify()->success(ROLE_CREATED);

            return redirect()->route('role.index');

        } catch (\Throwable $th) {

            notify()->error($th->getMessage());

            return redirect()->back();

        }

    }

    public function edit(Role $role)
    {

        $resources = Resource::all();
        return view('dashboard.role.edit',compact('role','resources'));
    }

    public function update(Request $request, Role $role)
    {

        $create = [];
        $read = [];
        $update = [];
        $delete = [];

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

            $role->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);

            // Registering role permissions

            $role->role_permissions()->delete();

            $create = $request->has('create') ? $request->create : [];

            $read = $request->has('read') ? $request->read : [];

            $update = $request->has('update') ? $request->update : [];

            $delete = $request->has('delete') ? $request->delete : [];

            $permissions_id = [...$create,...$read,...$update,...$delete];

            foreach($permissions_id as $line)
            {

                // $role->role_permissions()->create(['permission_id' => $line]);

                $r_permissions = new RolePermission;

                $r_permissions->permission_id = $line;
                $r_permissions->role_id = $role->id;

                $r_permissions->save();

            }

            // End scope

            notify()->success(ROLE_UPDATED);

            return redirect()->route('role.index');

        } catch (\Throwable $th) {

            notify()->error($th->getMessage());

            return redirect()->back();

        }

    }

    public function delete(Role $role)
    {

        try {

            $role->role_permissions()->delete();

            $role->delete();

            notify()->success(ROLE_DELETED);

            return redirect()->back();

        } catch (\Throwable $th) {

            notify()->error($th->getMessage());

            return redirect()->back();

        }

    }

}
