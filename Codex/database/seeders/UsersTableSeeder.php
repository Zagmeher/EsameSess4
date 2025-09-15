<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\contatti;
use App\Models\auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea contatto amministratore
        $adminContact = contatti::create([
            'idGruppo' => 1,
            'idStato' => 1,
            'nome' => 'Admin',
            'cognome' => 'Sistema',
            'sesso' => 1,
            'codiceFiscale' => 'ADMSST80A01H501Z',
            'partitaIva' => '',
            'cittadinanza' => 'Italiana',
            'idNazioneNascita' => 1,
            'cittaNascita' => 'Roma',
            'provinciaNascita' => 'RM',
            'dataNascita' => '1980-01-01',
        ]);

        // Crea credenziali amministratore
        $adminSalt = Str::random(16);
        auth::create([
            'idContatto' => $adminContact->idContatto,
            'user' => 'admin@example.com',
            'sfida' => Hash::make('admin123' . $adminSalt),
            'secretJWT' => Str::random(32),
            'scadenzaSfida' => 3600, // 1 ora
            'sale' => $adminSalt,
        ]);

        // Crea contatto utente normale
        $userContact = contatti::create([
            'idGruppo' => 2,
            'idStato' => 1,
            'nome' => 'Utente',
            'cognome' => 'Normale',
            'sesso' => 1,
            'codiceFiscale' => 'UTNNRM90A01H501Y',
            'partitaIva' => '',
            'cittadinanza' => 'Italiana',
            'idNazioneNascita' => 1,
            'cittaNascita' => 'Roma',
            'provinciaNascita' => 'RM',
            'dataNascita' => '1990-01-01',
        ]);

        // Crea credenziali utente normale
        $userSalt = Str::random(16);
        auth::create([
            'idContatto' => $userContact->idContatto,
            'user' => 'utente@example.com',
            'sfida' => Hash::make('utente123' . $userSalt),
            'secretJWT' => Str::random(32),
            'scadenzaSfida' => 3600, // 1 ora
            'sale' => $userSalt,
        ]);
    }
}
