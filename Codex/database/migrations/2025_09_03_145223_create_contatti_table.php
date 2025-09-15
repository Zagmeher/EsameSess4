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
        Schema::create('contatti', function (Blueprint $table) {
            $table->integer('idContatto', true, true)->length(10); // Chiave primaria INT(10)
            $table->integer('idGruppo', false, true)->length(10);
            $table->integer('idStato', false, true)->length(10);
            $table->string('nome', 45);
            $table->string('cognome', 45);
            $table->tinyInteger('sesso')->length(1);
            $table->string('codiceFiscale', 45);
            $table->string('partitaIva', 45);
            $table->string('cittadinanza', 45);
            $table->tinyInteger('idNazioneNascita')->length(4);
            $table->string('cittaNascita', 45);
            $table->string('provinciaNascita', 45);
            $table->date('dataNascita');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contatti');
    }
};
