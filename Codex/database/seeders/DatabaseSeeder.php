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
            
            // Dati dominio base
            ContattiSeeder::class, // Prima popolo i contatti random
            
            // Utenti di test per autenticazione JWT (admin e utente base) DOPO i contatti
            ContattiAuthSeeder::class,
            
            // Aggiungo i nuovi seeder per i dati di test
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
