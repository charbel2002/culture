<?php

namespace Database\Seeders;

use App\Models\Operation;
use App\Models\Resource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions')->delete();

        $operations = Operation::all();

        $resources = Resource::all();

        $permissions = [];

        $i = 1;

        foreach($operations as $operation)
        {

            foreach($resources as $resource)
            {

                $permissions [] = [ 'id' => $i, 'slug' => Str::slug( $operation->name . '-' . $resource->name ), 'operation_id' => $operation->id, 'resource_id' => $resource->id ];

                $i += 1;

            }

        }

        DB::table('permissions')->insert($permissions);

    }
}
