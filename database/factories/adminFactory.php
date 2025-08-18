<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition(): array
    {
        return [
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ];
    }

        public function dataadmin1()
    {
    return $this->state([
    'username' => 'admin',
    'password' => Hash::make('admin'),
    'role' => 'admin',
    ]);
    }
    public function dataadmin2()
    {
    return $this->state([
    'username' => 'guru',
    'password' => Hash::make('guru'),
    'role' => 'guru',
    ]);
    }
}
