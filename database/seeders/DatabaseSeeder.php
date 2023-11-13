<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create([
            'name' => 'master_admin'
        ]);

        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'user'
        ]);

        User::create([
            'name' => 'master_admin',
            'email' => 'theimaginebreaker00@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $master_admin = User::where('name', 'master_admin')->first();
        $role_master_admin = Role::where('name', 'master_admin')->first();

        $master_admin->roles()->attach($role_master_admin->id);
    }
}
