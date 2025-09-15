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
        Schema::create('auth', function (Blueprint $table) {
            $table->integer('idAuth', true, true); // AUTO_INCREMENT
            $table->integer('idContatto')->unsigned();
            $table->string('user', 255);
            $table->string('sfida', 255);
            $table->string('secretJWT', 255);
            $table->integer('scadenzaSfida')->unsigned();
            $table->string('sale', 255); // Aggiunta colonna per il sale
            $table->foreign('idContatto')->references('idContatto')->on('contatti')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auth');
    }
};
