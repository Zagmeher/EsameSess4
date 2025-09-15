<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class IndirizziSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Utilizzo Faker per generare dati realistici
        $faker = Faker::create('it_IT');
        
        // Disabilito temporaneamente il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Svuoto la tabella prima di inserire i dati di test
        DB::table('indirizzi')->truncate();
        
        // Definisco alcuni tipi di indirizzo (1: Residenza, 2: Domicilio, 3: Ufficio)
        $tipiIndirizzo = [1, 2, 3];
        
        // Inserisco 10 indirizzi di esempio (uno per ogni contatto)
        for ($i = 1; $i <= 10; $i++) {
            // Per varietà, assegniamo tipologie di indirizzo diverse
            $tipoIndirizzo = $faker->randomElement($tipiIndirizzo);
            
            // Utilizziamo ID di nazioni reali (1 = Italia, valori maggiori per altre nazioni)
            $idNazione = $faker->numberBetween(1, 20);
            
            // Per gli indirizzi italiani, utilizziamo comuni italiani reali
            $idComuneItaliano = ($idNazione == 1) ? $faker->numberBetween(1, 8000) : null;
            
            // Preparazione dati con controllo per idComuneItaliano
            $indirizzo = [
                'idIndirizzo' => $i,
                'idTipoIndirizzo' => $tipoIndirizzo,
                'idContatto' => $i, // Colleghiamo ogni indirizzo a un contatto
                'idNazione' => $idNazione,
                'cap' => $faker->postcode,
                'indirizzo' => $faker->streetAddress,
                'civico' => $faker->buildingNumber,
                'localita' => $faker->city,
                'created_at' => now(),
                'updated_at' => now()
            ];
            
            // Se l'indirizzo è in Italia (idNazione = 1), assegniamo un comune italiano
            if ($idNazione == 1) {
                $indirizzo['idComuneItaliano'] = $idComuneItaliano;
            } else {
                $indirizzo['idComuneItaliano'] = null;
            }
            
            DB::table('indirizzi')->insert($indirizzo);
        }
        
        // Riabilito il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('Inseriti 10 indirizzi di test!');
    }
}
