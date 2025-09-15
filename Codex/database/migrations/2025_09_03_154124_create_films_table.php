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
        Schema::create('film', function (Blueprint $table) {
            $table->integer('idFilm', true, true)->length(10); // Chiave primaria INT(10)
            $table->tinyInteger('idCategoria')->length(3);
            $table->string('titolo', 255);
            $table->string('descrizione', 255);
            $table->tinyInteger('durata')->length(3);
            $table->string('regista', 45);
            $table->string('attori', 45);
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
        Schema::dropIfExists('film');
    }
};
