<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class OperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('operations')->delete();

        $operations = array(
            ['id' => 1, 'name' => 'create' ],
            ['id' => 2, 'name' => 'read' ],
            ['id' => 3, 'name' => 'update' ],
            ['id' => 4, 'name' => 'delete' ]
        );

        DB::table('operations')->insert($operations);

    }
}
