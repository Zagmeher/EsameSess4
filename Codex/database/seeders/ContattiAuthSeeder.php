<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\contatti;
use App\Models\auth;

class ContattiAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crea un contatto amministratore
        $adminContatto = contatti::create([
            'nome' => 'Admin',
            'cognome' => 'Sistema',
            'sesso' => 1, // Assumo 1=maschio, 2=femmina
            'codiceFiscale' => 'DMNSTN80A01H501X',
            'partitaIva' => '',
            'cittadinanza' => 'Italiana',
            'idNazioneNascita' => 1, // ID per Italia
            'cittaNascita' => 'Roma',
            'provinciaNascita' => 'RM',
            'dataNascita' => '1980-01-01',
            'idGruppo' => 1, // Admin group
            'idStato' => 1  // Attivo
        ]);
        
        // Crea credenziali di autenticazione per l'admin
        $adminSale = Str::random(32);
        auth::create([
            'idContatto' => $adminContatto->idContatto,
            'user' => 'admin@example.com',
            'sfida' => Hash::make('admin123' . $adminSale), // password + sale
            'secretJWT' => Str::random(64),
            'scadenzaSfida' => time() + (60 * 60 * 24 * 30), // 30 giorni
            'sale' => $adminSale
        ]);
        
        // 2. Crea un contatto utente normale
        $userContatto = contatti::create([
            'nome' => 'Utente',
            'cognome' => 'Normale',
            'sesso' => 2, // Assumo 2=femmina
            'codiceFiscale' => 'RSSMRA85B01H501Y',
            'partitaIva' => '',
            'cittadinanza' => 'Italiana',
            'idNazioneNascita' => 1, // ID per Italia
            'cittaNascita' => 'Milano',
            'provinciaNascita' => 'MI',
            'dataNascita' => '1985-02-01',
            'idGruppo' => 2, // Regular user group
            'idStato' => 1  // Attivo
        ]);
        
        // Crea credenziali di autenticazione per l'utente
        $userSale = Str::random(32);
        auth::create([
            'idContatto' => $userContatto->idContatto,
            'user' => 'utente@example.com',
            'sfida' => Hash::make('utente123' . $userSale), // password + sale
            'secretJWT' => Str::random(64),
            'scadenzaSfida' => time() + (60 * 60 * 24 * 30), // 30 giorni
            'sale' => $userSale
        ]);
        
        $this->command->info('Contatti e credenziali create con successo!');
    }
}
