<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class ResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resources')->delete();

        $tables = DB::select('SHOW TABLES');

        // dd($tables[0]->{'Tables_in_' . env('DB_DATABASE')});

        $resources = [];
        $i = 1;

        foreach ($tables as $table) {

            // $resources [] = [ 'id' => $i, 'name' => $table->{'Tables_in_' . env('DB_DATABASE')} , 'slug' => Str::slug($table->{'Tables_in_' . env('DB_DATABASE')})  ];

            $resources [] = [ 'id' => $i, 'name' => $table->{'Tables_in_culture'} , 'slug' => Str::slug($table->{'Tables_in_culture'})  ];

            $i += 1;

        }

        DB::table('resources')->insert($resources);

    }
}
