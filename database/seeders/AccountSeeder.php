<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    public function run()
    {
        DB::table('accounts')->insert([
            'name' => 'Teste',
            'number' => 654,
            'fund' => 0,
            'user_id' => 1,
        ]);

        \App\Models\Account::factory()->count(5)->create();
    }
}
