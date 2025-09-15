<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        // Creiamo la tabella con la struttura corretta
        Schema::create('indirizzi', function (Blueprint $table) {
            $table->integer('idIndirizzo', true, true)->length(10); // Chiave primaria INT(10)
            $table->integer('idTipoIndirizzo', false, true)->length(10);
            $table->integer('idContatto', false, true)->length(10);
            $table->integer('idNazione', false, true)->length(10);
            $table->integer('idComuneItaliano', false, true)->length(10)->nullable();
            $table->string('cap', 10);
            $table->string('indirizzo', 45);
            $table->string('civico', 10);
            $table->string('localita', 45);
            $table->string('altro_1', 100)->nullable();
            $table->string('altro_2', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminazione della tabella
        Schema::dropIfExists('indirizzi');
        
        // Non ricreiamo la tabella originale in down perché dovrebbe essere gestita
        // dalla migrazione originale in caso di rollback fino a quel punto
    }
};
