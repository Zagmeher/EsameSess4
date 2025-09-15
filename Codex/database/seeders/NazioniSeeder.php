<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NazioniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disabilita il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Svuota la tabella prima dell'importazione
        DB::table('nazioni')->truncate();
        
        // Percorso del file CSV
        $csvFile = base_path('nazioni.csv');
        
        // Verifica che il file esista
        if (!File::exists($csvFile)) {
            $this->command->error('File CSV non trovato: ' . $csvFile);
            return;
        }
        
        // Legge il file CSV
        $csvData = File::get($csvFile);
        $rows = explode("\n", $csvData);
        
        // Inserisce ogni riga nella tabella
        foreach ($rows as $row) {
            if (empty(trim($row))) continue;
            
            $data = str_getcsv($row, ',');
            
            // Verifica che ci siano abbastanza colonne
            if (count($data) >= 6) {
                DB::table('nazioni')->insert([
                    'idNazione' => $data[0],
                    'nome' => $data[1],
                    'continente' => $data[2],
                    'iso' => $data[3],
                    'iso3' => $data[4],
                    'prefissoTelefonico' => $data[5] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        
        // Riabilita il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('Importazione dati nazioni completata con successo!');
    }
}
