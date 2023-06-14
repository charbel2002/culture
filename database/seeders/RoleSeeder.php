<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->delete();

        $role = [ 'id' => 1, 'name' => 'super administrateur', 'slug' => Str::slug('super administrateur') ];

        $query = Role::create($role);

        $permissions = Permission::all();

        $i = 1;

       foreach($permissions as $permission)
       {

            RolePermission::create([
                'id' => $i,
                'role_id' => $query->id,
                'permission_id' => $permission->id
            ]);

            $i += 1;

       }

    }
}
