<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EpisodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');
        
        // Episodi per la Serie TV con ID 1 (10 valori)
        for ($i = 1; $i <= 10; $i++) {
            DB::table('episodi')->insert([
                'idSerieTv' => 1,
                'titolo' => $faker->sentence(3),
                'descrizione' => $faker->text(45),
                'numeroStagione' => $faker->numberBetween(1, 5),
                'numeroEpisodio' => $i,
                'durata' => $faker->numberBetween(20, 60),
                'anno' => $faker->numberBetween(2015, 2025),
                'idImmagine' => $faker->numberBetween(1, 50),
                'idFilmato' => $faker->numberBetween(1, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // Episodi per la Serie TV con ID 2 (10 valori)
        for ($i = 1; $i <= 10; $i++) {
            DB::table('episodi')->insert([
                'idSerieTv' => 2,
                'titolo' => $faker->sentence(3),
                'descrizione' => $faker->text(45),
                'numeroStagione' => $faker->numberBetween(1, 3),
                'numeroEpisodio' => $i,
                'durata' => $faker->numberBetween(25, 55),
                'anno' => $faker->numberBetween(2018, 2025),
                'idImmagine' => $faker->numberBetween(51, 100),
                'idFilmato' => $faker->numberBetween(51, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        echo "Inseriti 20 episodi di test!\n";
    }
}
