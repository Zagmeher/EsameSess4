<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disabilito temporaneamente il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Svuoto la tabella prima di inserire i dati
        DB::table('categorie')->truncate();
        
        // Categorie da inserire (solo nome)
        $categorie = [
            'Azione',
            'Commedia',
            'Drammatico',
            'Fantascienza',
            'Horror',
            'Romantico',
            'Documentario',
            'Animazione',
            'Thriller',
            'Avventura'
        ];
        
        $now = Carbon::now();
        
        // Inserisco le categorie nel database
        foreach ($categorie as $index => $categoria) {
            DB::table('categorie')->insert([
                'idCategoria' => $index + 1,  // ID progressivo
                'nome' => $categoria,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }
        
        // Riabilito il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Gestisci il messaggio info in modo sicuro
        if (isset($this->command)) {
            $this->command->info('Inserite 10 categorie di test!');
        }
    }
}

