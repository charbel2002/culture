<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->delete();

        $user = [ 'id' => 1, 'password' => bcrypt('morel'), 'email' => 'indrabg2002@gmail.com' ];

        $query = User::create($user);

        UserRole::create([
            'id' => 1,
            'user_id' => $query->id,
            'role_id' => 1
        ]);

    }
}
