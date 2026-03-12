<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use Faker\Factory as Faker;

class MemberSeeder extends Seeder
{
      public function run(): void
      {
            $faker = Faker::create();

            for ($i = 0; $i < 20; $i++) {
                  Member::create([
                        'first_name' => $faker->firstName,
                        'last_name'  => $faker->lastName,
                        'email'      => $faker->unique()->safeEmail,
                        'phone'      => $faker->numerify('##########'),
                        'age'        => $faker->numberBetween(18, 70),
                        'professional_summary' => $faker->sentence(12),
                        'address'    => $faker->address,   // ← REQUIRED
                  ]);
            }
      }
}
