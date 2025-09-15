<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ContattiSeeder extends Seeder
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
        DB::table('contatti')->truncate();
        
        // Inserisco 10 contatti di esempio
        for ($i = 1; $i <= 10; $i++) {
            $sesso = $faker->randomElement([0, 1]); // 0 per maschio, 1 per femmina
            $nome = $sesso ? $faker->firstNameFemale : $faker->firstNameMale;
            $cognome = $faker->lastName;
            
            DB::table('contatti')->insert([
                'idContatto' => $i,
                'idGruppo' => $faker->numberBetween(1, 5),
                'idStato' => $faker->numberBetween(1, 3),
                'nome' => $nome,
                'cognome' => $cognome,
                'sesso' => $sesso,
                'codiceFiscale' => strtoupper(Str::random(16)),
                'partitaIva' => $faker->numberBetween(10000000000, 99999999999),
                'cittadinanza' => 'Italiana',
                'idNazioneNascita' => 1, // 1 = Italia
                'cittaNascita' => $faker->city,
                'provinciaNascita' => $faker->randomElement(['MI', 'RM', 'TO', 'NA', 'BO', 'FI', 'BA', 'PA', 'VE', 'CT']),
                'dataNascita' => $faker->date('Y-m-d', '-18 years'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
        // Riabilito il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('Inseriti 10 contatti di test!');
    }
}
