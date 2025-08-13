<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome completo do participante
            $table->string('cpf', 14)->nullable(); // CPF formatado (000.000.000-00)
            $table->string('email'); // Email do participante
            $table->string('phone', 20); // Telefone (formato livre)
            $table->string('district'); // Bairro do participante
            $table->string('age_range', 20)->nullable(); // Faixa etária
            $table->text('suggestions')->nullable(); // Sugestões adicionais
            $table->string('ip_address', 45)->nullable(); // IP do usuário
            $table->text('user_agent')->nullable(); // User Agent do navegador
            $table->timestamp('completed_at')->nullable(); // Quando foi finalizado
            $table->string('protocol_number')->unique()->nullable(); // Número de protocolo
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
    }
};
