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
        Schema::create('recapiti', function (Blueprint $table) {
            $table->integer('idRecapito', true, true)->length(10); // Chiave primaria INT(10)
            $table->integer('idContatto', false, true)->length(10);
            $table->integer('idTipoRecapito', false, true)->length(10);
            $table->string('recapito', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recapiti');
    }
};
