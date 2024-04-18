<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail',
                'role' => 'admin',
                'password' => bcrypt('admin')
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail',
                'role' => 'user',
                'password' => bcrypt('user')
            ]
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
