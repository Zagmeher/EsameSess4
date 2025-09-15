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
        Schema::create('episodi', function (Blueprint $table) {
            $table->integer('idEpisodio', true, true)->length(10); // Chiave primaria INT(10)
            $table->integer('idSerieTv', false, true)->length(10); // Chiave esterna per SerieTv
            $table->string('titolo', 255);
            $table->string('descrizione', 45);
            $table->tinyInteger('numeroStagione')->length(3);
            $table->tinyInteger('numeroEpisodio')->length(3);
            $table->tinyInteger('durata')->length(3);
            $table->smallInteger('anno')->length(5);
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
        Schema::dropIfExists('episodi');
    }
};
