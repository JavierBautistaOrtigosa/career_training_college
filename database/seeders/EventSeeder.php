<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
      public function run(): void
      {
            $faker = Faker::create();

            $categories = ['Workshop', 'Seminar', 'Webinar', 'Training', 'Other'];

            for ($i = 0; $i < 20; $i++) {
                  Event::create([
                        'title'       => $faker->sentence(3),
                        'date_time'   => $faker->dateTimeBetween('-1 month', '+2 months'),
                        'location'    => $faker->city,
                        'category'    => $faker->randomElement($categories),
                        'description' => $faker->paragraph(3),
                        // REMOVE image_path
                  ]);
            }
      }
}
