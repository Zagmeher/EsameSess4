<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FilmsSeeder extends Seeder
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
        DB::table('film')->truncate();
        
        // Definisco dei film specifici per avere dati realistici e coerenti
        $films = [
            [
                'titolo' => 'Il Padrino',
                'descrizione' => 'La storia della famiglia mafiosa Corleone dal 1945 al 1955.',
                'durata' => 175,
                'regista' => 'Francis Ford Coppola',
                'attori' => 'Marlon Brando, Al Pacino',
                'anno' => 1972,
                'idCategoria' => 1 // Ipotizziamo 1 = Drama
            ],
            [
                'titolo' => 'Pulp Fiction',
                'descrizione' => 'Le vite di due sicari, un pugile, un gangster e sua moglie si intrecciano in quattro storie.',
                'durata' => 154,
                'regista' => 'Quentin Tarantino',
                'attori' => 'John Travolta, Uma Thurman',
                'anno' => 1994,
                'idCategoria' => 3 // Ipotizziamo 3 = Crime
            ],
            [
                'titolo' => 'Inception',
                'descrizione' => 'Un ladro che ruba segreti aziendali infiltrandosi nel subconscio.',
                'durata' => 148,
                'regista' => 'Christopher Nolan',
                'attori' => 'Leonardo DiCaprio, Joseph Gordon-Levitt',
                'anno' => 2010,
                'idCategoria' => 2 // Ipotizziamo 2 = Sci-Fi
            ],
            [
                'titolo' => 'La vita è bella',
                'descrizione' => 'Un padre usa l\'immaginazione per proteggere il figlio dagli orrori dell\'Olocausto.',
                'durata' => 116,
                'regista' => 'Roberto Benigni',
                'attori' => 'Roberto Benigni, Nicoletta Braschi',
                'anno' => 1997,
                'idCategoria' => 4 // Ipotizziamo 4 = Commedia/Drama
            ],
            [
                'titolo' => 'Avatar',
                'descrizione' => 'Un marine paraplegico inviato sulla luna Pandora per una missione speciale.',
                'durata' => 162,
                'regista' => 'James Cameron',
                'attori' => 'Sam Worthington, Zoe Saldana',
                'anno' => 2009,
                'idCategoria' => 2 // Ipotizziamo 2 = Sci-Fi
            ],
        ];
        
        // Inserisco i 5 film nella tabella
        foreach ($films as $index => $film) {
            DB::table('film')->insert([
                'idFilm' => $index + 1,
                'idCategoria' => $film['idCategoria'],
                'titolo' => $film['titolo'],
                'descrizione' => $film['descrizione'],
                'durata' => $film['durata'],
                'regista' => $film['regista'],
                'attori' => $film['attori'],
                'anno' => $film['anno'],
                'idImmagine' => $faker->numberBetween(1, 20),
                'idFilmato' => $faker->numberBetween(1, 15),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
        // Riabilito il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('Inseriti 5 film di test!');
    }
}
