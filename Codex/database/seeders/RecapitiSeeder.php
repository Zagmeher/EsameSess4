<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\recapiti;

class RecapitiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assicurarsi che la tabella sia vuota prima di inserire nuovi dati
        DB::table('recapiti')->truncate();
        
        // Tipi di recapiti:
        // 1 = Email
        // 2 = Telefono
        // 3 = Cellulare
        // 4 = Fax
        // 5 = Social Media
        
        // Array di dati di recapito
        $recapitiData = [
            // Recapiti per il contatto 1
            [
                'idContatto' => 1,
                'idTipoRecapito' => 1,
                'recapito' => 'mario.rossi@example.com'
            ],
            [
                'idContatto' => 1,
                'idTipoRecapito' => 3,
                'recapito' => '+39 333 1234567'
            ],
            // Recapiti per il contatto 2
            [
                'idContatto' => 2,
                'idTipoRecapito' => 1,
                'recapito' => 'luigi.verdi@example.com'
            ],
            [
                'idContatto' => 2,
                'idTipoRecapito' => 2,
                'recapito' => '+39 02 12345678'
            ],
            [
                'idContatto' => 2,
                'idTipoRecapito' => 3,
                'recapito' => '+39 345 7654321'
            ],
            // Recapiti per il contatto 3
            [
                'idContatto' => 3,
                'idTipoRecapito' => 1,
                'recapito' => 'anna.bianchi@example.com'
            ],
            [
                'idContatto' => 3,
                'idTipoRecapito' => 3,
                'recapito' => '+39 366 9876543'
            ],
            [
                'idContatto' => 3,
                'idTipoRecapito' => 4,
                'recapito' => '+39 02 87654321'
            ],
            // Recapiti per il contatto 4
            [
                'idContatto' => 4,
                'idTipoRecapito' => 1,
                'recapito' => 'roberto.neri@example.com'
            ],
            [
                'idContatto' => 4,
                'idTipoRecapito' => 5,
                'recapito' => '@robertoneri'
            ],
            // Recapiti per il contatto 5
            [
                'idContatto' => 5,
                'idTipoRecapito' => 1,
                'recapito' => 'laura.gialli@example.com'
            ],
            [
                'idContatto' => 5,
                'idTipoRecapito' => 2,
                'recapito' => '+39 06 12348765'
            ],
            [
                'idContatto' => 5,
                'idTipoRecapito' => 3,
                'recapito' => '+39 320 1234567'
            ],
        ];
        
        // Inseriamo i dati nella tabella recapiti
        $idRecapito = 1;
        foreach ($recapitiData as $recapitoItem) {
            recapiti::create([
                'idRecapito' => $idRecapito++,
                'idContatto' => $recapitoItem['idContatto'],
                'idTipoRecapito' => $recapitoItem['idTipoRecapito'],
                'recapito' => $recapitoItem['recapito']
            ]);
        }
        
        $this->command->info('Tabella recapiti popolata con successo!');
    }
}
