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
        Schema::create('filmes', function (Blueprint $table) {
            $table->id();
            // Relação com a tabela studios
            $table->foreignId('estudio_id')->on('estudios');

            $table->string('titulo'); // Título do filme
            $table->string('capa')->nullable(); // Capa do filme
            $table->date('data_lancamento')->nullable(); // Data de lançamento

            // Campos opcionais
            $table->string('genero')->nullable(); // Género (Ação, Comédia, etc.)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filmes');
    }
};
