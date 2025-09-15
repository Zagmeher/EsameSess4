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
        Schema::create('comuni_italiani', function (Blueprint $table) {
            $table->integer('idComuneItaliano')->unsigned()->primary();
            $table->string('nome', 100);
            $table->string('regione', 100);
            $table->string('provincia', 100);
            $table->string('siglaProvincia', 2);
            $table->string('codiceCatastale', 4);
            $table->string('CAP', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comuni_italiani');
    }
};
