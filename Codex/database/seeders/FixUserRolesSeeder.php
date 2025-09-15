<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\contatti;
use Illuminate\Support\Facades\DB;

class FixUserRolesSeeder extends Seeder
{
    /**
     * Corregge i ruoli degli utenti nel database
     */
    public function run(): void
    {
        // Disabilita il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Trova e aggiorna admin@example.com per essere admin (idGruppo = 1)
        $adminAuth = \App\Models\auth::where('user', 'admin@example.com')->first();
        if ($adminAuth) {
            contatti::where('idContatto', $adminAuth->idContatto)
                ->update(['idGruppo' => 1]); // Admin
            $this->command->info('✅ admin@example.com impostato come ADMIN (idGruppo = 1)');
        }
        
        // Trova e aggiorna utente@example.com per essere user normale (idGruppo = 2)  
        $userAuth = \App\Models\auth::where('user', 'utente@example.com')->first();
        if ($userAuth) {
            contatti::where('idContatto', $userAuth->idContatto)
                ->update(['idGruppo' => 2]); // User normale
            $this->command->info('✅ utente@example.com impostato come USER (idGruppo = 2)');
        }
        
        // Riabilita il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('🎯 Ruoli corretti:');
        $this->command->info('   - admin@example.com → ADMIN (può tutto)');
        $this->command->info('   - utente@example.com → USER (lettura + propri dati)');
    }
}