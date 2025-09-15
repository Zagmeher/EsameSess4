<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ComuniSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Disabilita il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Svuota la tabella prima dell'importazione
        DB::table('comuni_italiani')->truncate();
        
        // Percorso del file CSV
        $csvFile = base_path('comuniItaliani.csv');
        
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
            if (count($data) >= 7) {
                DB::table('comuni_italiani')->insert([
                    'idComuneItaliano' => $data[0],
                    'nome' => $data[1],
                    'regione' => $data[2],
                    'provincia' => $data[3],
                    'siglaProvincia' => $data[4],
                    'codiceCatastale' => $data[5],
                    'CAP' => $data[6],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        
        // Riabilita il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('Importazione dati comuni completata con successo!');
}
}