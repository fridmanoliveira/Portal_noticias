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
            $table->foreignId('categoria_id')->constrained('categoria_noticias')->onDelete('cascade');
            $table->string('titulo');
            $table->string('slug');
            $table->text('resumo');
            $table->string('imagem')->nullable();
            $table->longText('conteudo');
            $table->timestamp('publicado_em')->nullable();
            $table->boolean('ativo')->default(true);
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
