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
        Schema::create('serietv', function (Blueprint $table) {
            $table->integer('idSerieTv', true, true)->length(10); // Chiave primaria INT(10)
            $table->tinyInteger('idCategoria')->length(3);
            $table->string('nome', 255);
            $table->string('descrizione', 45);
            $table->tinyInteger('totaleStaioni')->length(3);
            $table->tinyInteger('numeroEpisodio')->length(3);
            $table->string('regista', 45);
            $table->string('attori', 45);
            $table->smallInteger('annoInizio')->length(5);
            $table->smallInteger('annoFine')->length(5);
            $table->integer('idImmagine', false, true)->length(10);
            $table->integer('idFilmato', false, true)->length(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serietv');
    }
};
