<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Texto da pergunta
            $table->text('description')->nullable(); // Descrição detalhada da pergunta
            $table->enum('type', ['checkbox', 'radio', 'text', 'select']); // Tipo da pergunta
            $table->boolean('is_required')->default(true); // Se a pergunta é obrigatória
            $table->string('section')->nullable(); // Seção/categoria da pergunta
            $table->integer('order')->default(0); // Ordem de exibição
            $table->boolean('has_other_option')->default(false); // Se tem opção "Outro"
            $table->string('other_option_label')->nullable(); // Label personalizado para "Outro"
            $table->timestamps();
            $table->softDeletes(); // Para deletar sem perder dados históricos
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
