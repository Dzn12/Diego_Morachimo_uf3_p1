<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FilmActorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $filmIds = DB::table('films')->pluck('id')->toArray();
        $actorIds = DB::table('actors')->pluck('id')->toArray();

        foreach ($filmIds as $filmId) {
            $numberOfActors = $faker->numberBetween(1, 3);
            $randomActorIds = $faker->randomElements($actorIds, $numberOfActors);

            foreach ($randomActorIds as $actorId) {
                $alias = $faker->optional()->word; // Genera un alias de forma opcional

                DB::table('films_actors')->insert([
                    'film_id' => $filmId,
                    'actor_id' => $actorId,
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
                ]);

            }
        }
    }
}
