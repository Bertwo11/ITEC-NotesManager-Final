<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Gumawa ng admin account
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@notesmanager.com',
            'password' => bcrypt('admin123'),
            'role'     => 'admin',
        ]);
    }
}