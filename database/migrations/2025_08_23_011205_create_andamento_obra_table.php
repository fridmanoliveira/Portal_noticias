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
        Schema::create('andamento_obra', function (Blueprint $table) {
            // A coluna 'id' já é um BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->id();

            $table->unsignedBigInteger('obra_id');
            $table->string('titulo');
            $table->string('descricao');
            $table->string('anexo');
            $table->date('data');
            $table->unsignedInteger('progresso');
            $table->foreign('obra_id')->references('id')->on('obras')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('andamento_obra');
    }
};
