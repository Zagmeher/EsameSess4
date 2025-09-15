<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SessioniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disabilito temporaneamente il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Svuoto la tabella prima di inserire i dati
        DB::table('sessioni')->truncate();
        
        // Otteniamo gli ID dei contatti esistenti
        $contattiIds = DB::table('contatti')->pluck('idContatto')->toArray();
        
        // Se non ci sono contatti, creiamo 10 sessioni con ID contatti fittizi da 1 a 10
        if (empty($contattiIds)) {
            $contattiIds = range(1, 10);
        }
        
        $now = Carbon::now();
        
        // Creiamo 15 sessioni
        for ($i = 1; $i <= 15; $i++) {
            // Scegliamo un contatto casuale
            $idContatto = $contattiIds[array_rand($contattiIds)];
            
            // Generiamo un token unico
            $token = Str::random(64);
            
            // La sessione scade tra 1-30 giorni (timestamp UNIX)
            $scadenza = $now->copy()->addDays(rand(1, 30))->timestamp;
            
            DB::table('sessioni')->insert([
                'idSessione' => $i,
                'idContatto' => $idContatto,
                'token' => $token,
                'scadenzaSessione' => $scadenza,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
        
        // Riabilito il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('Inserite 15 sessioni di test!');
    }
}
