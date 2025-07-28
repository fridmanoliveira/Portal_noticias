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
            $table->unsignedBigInteger('categoria_id');
            $table->string('titulo');
            $table->text('resumo');
            $table->string('imagem');
            $table->dateTime('publicado_em')->nullable();
            $table->longText('conteudo');
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias_noticias')->onDelete('cascade');
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
