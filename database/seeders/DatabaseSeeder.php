<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin'
        ]);

        Role::create([
            'name' => 'Employee',
            'slug' => 'employee'
        ]);

        User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'role_id' => 1,
            'slug' => 'admin-admin',
            'email' => 'admin@admin.com',
            'created_by' => '0',
            'email_status' => 1,
            'status' => 1,
            'password' => Hash::make('123456789'),
        ]);

        User::create([
            'first_name' => 'employee1',
            'last_name' => 'emp',
            'role_id' => 2,
            'slug' => 'employee-employee',
            'email' => 'employee@gmail.com',
            'created_by' => '1',
            'email_status' => 1,
            'status' => 1,
            'password' => Hash::make('123456789'),
        ]);
    }
}
