<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            [
                'email' => 'it@amc-sarl.com',
            ],
            [
                'name' => 'IT',
                'password' => Hash::make('password'),
            ]
        );

        $user->assignRole('IT');
    }
}
