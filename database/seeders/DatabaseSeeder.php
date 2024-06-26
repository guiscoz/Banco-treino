<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AccountSeeder::class,
            // UsersTableSeeder::class,

            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesUsersTableSeeder::class,
        ]);
    }
}
