<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SerieTvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Utilizzo Faker per generare dati realistici
        $faker = Faker::create('it_IT');
        
        // Disabilito temporaneamente il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Svuoto la tabella prima di inserire i dati di test
        DB::table('serietv')->truncate();
        
        // Definisco alcuni array di valori possibili per rendere realistici i dati
        $categorie = range(1, 5); // Supponiamo che ci siano 5 categorie
        $registi = [
            'Steven Spielberg', 'Quentin Tarantino', 'Martin Scorsese',
            'Christopher Nolan', 'Spike Lee', 'Francis Ford Coppola',
            'Woody Allen', 'Federico Fellini', 'Paolo Sorrentino', 'Gabriele Muccino'
        ];
        
        $attoriPrincipali = [
            'Roberto Benigni, Nicoletta Braschi', 'Leonardo DiCaprio, Kate Winslet',
            'Tom Hanks, Meryl Streep', 'Brad Pitt, Angelina Jolie',
            'Robert De Niro, Al Pacino', 'Johnny Depp, Helena Bonham Carter',
            'Christian Bale, Anne Hathaway', 'Julia Roberts, Richard Gere',
            'Denzel Washington, Viola Davis', 'Jennifer Lawrence, Bradley Cooper'
        ];
        
        // Inserisco 10 serie TV di esempio
        for ($i = 1; $i <= 10; $i++) {
            $annoInizio = $faker->numberBetween(1990, 2023);
            $annoFine = $faker->optional(0.7, null)->numberBetween($annoInizio, 2025);
            
            if ($annoFine === null) {
                $annoFine = 0; // Serie ancora in produzione
            }
            
            // Limitiamo il numero di stagioni
            $totaleStaioni = $faker->numberBetween(1, 10);
            // Limitiamo il numero di episodi a un massimo di 100
            $numeroEpisodio = $faker->numberBetween(1, 100);
            
            DB::table('serietv')->insert([
                'idSerieTv' => $i,
                'idCategoria' => $faker->randomElement($categorie),
                'nome' => $faker->sentence(3),
                'descrizione' => $faker->text(45),
                'totaleStaioni' => $totaleStaioni,
                'numeroEpisodio' => $numeroEpisodio,
                'regista' => $faker->randomElement($registi),
                'attori' => $faker->randomElement($attoriPrincipali),
                'annoInizio' => $annoInizio,
                'annoFine' => $annoFine,
                'idImmagine' => $faker->numberBetween(1, 20),
                'idFilmato' => $faker->numberBetween(1, 15),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
        // Riabilito il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('Inserite 10 serie TV di test!');
    }
}
