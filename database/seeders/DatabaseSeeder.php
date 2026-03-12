<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
      use WithoutModelEvents;

      public function run(): void
      {
            // Seeders
            $this->call([
                  MemberSeeder::class,
                  EventSeeder::class,
            ]);

            // Create a general user
            User::create([
                  'name' => 'Test User',
                  'email' => 'test@example.com',
                  'password' => Hash::make('password123'),
                  'role' => 'user',
            ]);

            // Create an admin user
            User::create([
                  'name' => 'Admin User',
                  'email' => 'admin@example.com',
                  'password' => Hash::make('admin123'),
                  'role' => 'admin',
            ]);
      }
}
