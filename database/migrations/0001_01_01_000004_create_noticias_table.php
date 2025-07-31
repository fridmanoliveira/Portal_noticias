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

        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categoria_noticias')->onDelete('cascade'); // Chave estrangeira para categoria_noticias
            $table->string('titulo');
            $table->text('resumo');
            $table->string('imagem')->nullable(); // Caminho da imagem, pode ser nulo
            $table->longText('conteudo'); // Conteúdo completo da notícia
            $table->timestamp('publicado_em')->nullable(); // Data e hora de publicação
            $table->boolean('ativo')->default(true); // Se a notícia está ativa ou não
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
