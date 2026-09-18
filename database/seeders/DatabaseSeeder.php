<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\ClientFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
//        User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            RolePermissionSeeder::class,
            AdminUserSeeder::class,
            DepartmentSeeder::class,
//            EmployeeSeeder::class,
            AdminUserSeeder::class,
            ClientSeeder::class
        ]);
    }
}
