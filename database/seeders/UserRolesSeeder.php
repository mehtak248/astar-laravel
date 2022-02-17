<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_roles')->insert([
           'name' => 'Admin'
        ]);

        \DB::table('user_roles')->insert([
            'name' => 'User'
        ]);
    }
}
