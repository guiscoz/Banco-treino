<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $newPermissions = [
            [
                'name' => 'Gerenciar permissões'
            ], [
                'name' => 'Gerenciar perfis'
            ], [
                'name' => 'Gerenciar usuários'
            ], [
                'name' => 'Acessar o Google'
            ]
        ];

        foreach($newPermissions as $keyPermissions => $permission) {
            Permission::create($permission);
        }
    }
}
