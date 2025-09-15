<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Eseguo il seeder per i dati già esistenti
        $this->call([
            NazioniSeeder::class,
            ComuniSeeder::class,
            
            // Utenti di test per autenticazione JWT (rimosso in favore di ContattiAuthSeeder)
            // UsersTableSeeder::class,
            
            // Seeder per contatti e autenticazione
            ContattiAuthSeeder::class,
            
            // Aggiungo i nuovi seeder per i dati di test
            ContattiSeeder::class,
            PasswordsSeeder::class,
            IndirizziSeeder::class,
            SerieTvSeeder::class,
            FilmsSeeder::class,
            EpisodiSeeder::class,
            CategorieSeeder::class,
            SessioniSeeder::class,
        ]);
    }
}
