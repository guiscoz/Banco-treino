<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


class AccountFactory extends Factory {
    protected $model = Account::class;

    public function definition(){
        return [
            'name' => $this->faker->unique()->name,
            'number' => rand(0, 999),
            'fund' => 0,
            'user_id' => 2,
        ];
    }
}