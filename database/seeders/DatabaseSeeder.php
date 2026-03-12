<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\MemberSeeder;
use Database\Seeders\EventSeeder;

class DatabaseSeeder extends Seeder
{
      use WithoutModelEvents;

      /**
       * Seed the application's database.
       */
      public function run(): void
      {
            // Seeders
            $this->call([
                  MemberSeeder::class,
                  EventSeeder::class,
            ]);

            // Create a general user
            User::factory()->create([
                  'name' => 'Test User',
                  'email' => 'test@example.com',
                  'role' => 'user',
            ]);

            // Create an admin user
            User::factory()->create([
                  'name' => 'Admin User',
                  'email' => 'admin@example.com',
                  'role' => 'admin',
            ]);
      }
}
