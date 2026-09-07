<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@sikara.local',
            ],
            [
                'name' => 'Admin Inventaris',
                'password' => 'admin12345',
            ]
        );
    }
}
