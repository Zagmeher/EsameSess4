<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disabilito temporaneamente il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Svuoto la tabella prima di inserire i dati di test
        DB::table('passwords')->truncate();
        
        // Inserisco 10 password di esempio (una per ogni contatto)
        for ($i = 1; $i <= 10; $i++) {
            $salt = Str::random(16);
            $password = "password" . $i; // Password semplice per test
            $hashedPassword = Hash::make($password . $salt);
            
            DB::table('passwords')->insert([
                'idContatto' => $i, // Colleghiamo ogni password a un contatto
                'psw' => $hashedPassword,
                'sale' => $salt,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
        // Riabilito il controllo delle chiavi esterne
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('Inserite 10 password di test!');
    }
}
