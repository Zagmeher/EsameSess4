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
        Schema::table('film', function (Blueprint $table) {
            // Modifica il tipo di dato della colonna durata da tinyint a smallint
            $table->smallInteger('durata')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('film', function (Blueprint $table) {
            // Ripristina il tipo di dato originale (tinyint)
            $table->tinyInteger('durata')->change();
        });
    }
};
