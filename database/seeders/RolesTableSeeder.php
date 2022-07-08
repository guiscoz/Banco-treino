<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newRoles = [
            [
                'name' => 'Super Admin'
            ],
            [
                'name' => 'Administrador'
            ], 
            [
                'name' => 'Suporte'
            ]
        ];

        foreach($newRoles as $keyRoles => $roles) {
            Role::create($roles);
        }
    }
}
