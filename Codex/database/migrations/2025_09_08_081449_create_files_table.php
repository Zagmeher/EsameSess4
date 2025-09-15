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
        Schema::create('file', function (Blueprint $table) {
            $table->increments('idFile');
            $table->integer('idRecord')->unsigned();
            $table->string('tabella', 45);
            $table->string('nome', 45);
            $table->integer('size')->unsigned();
            $table->string('ext', 6);
            $table->text('descrizione')->comment('TINYTEXT in MySQL');
            $table->string('formato', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file');
    }
};
