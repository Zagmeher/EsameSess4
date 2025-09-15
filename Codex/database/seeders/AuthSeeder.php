<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\auth;
use App\Models\contatti;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disabilito temporaneamente il controllo delle chiavi esterne
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Svuoto la tabella prima di inserire i dati di test
        \DB::table('auth')->truncate();
        
        // Recupero i contatti esistenti
        $contatti = contatti::all();
        
        // Se non ci sono contatti, genera un messaggio di errore
        if ($contatti->isEmpty()) {
            $this->command->error('Nessun contatto trovato. Esegui prima il seeder dei contatti.');
            return;
        }
        
        foreach ($contatti as $index => $contatto) {
            // Genero un sale casuale
            $sale = Str::random(32);
            
            // Password standard per test (in produzione dovrebbero essere diverse)
            $password = "password" . $index;
            
            // Genero la sfida (password hashata con il sale)
            $sfida = Hash::make($password . $sale);
            
            // Genero un secretJWT casuale
            $secretJWT = Str::random(32);
            
            // Imposto una scadenza (per esempio, 30 giorni da oggi in timestamp)
            $scadenzaSfida = now()->addDays(30)->timestamp;
            
            // Creo il record di autenticazione
            auth::create([
                'idContatto' => $contatto->idContatto,
                'user' => 'user' . $contatto->idContatto . '@example.com',
                'sfida' => $sfida,
                'secretJWT' => $secretJWT,
                'scadenzaSfida' => $scadenzaSfida,
                'sale' => $sale
            ]);
        }
        
        // Riabilito il controllo delle chiavi esterne
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('Credenziali di autenticazione create con successo per ' . $contatti->count() . ' contatti!');
    }
}
