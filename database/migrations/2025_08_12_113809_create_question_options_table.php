<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->string('option_text'); // Texto da opção
            $table->text('description')->nullable(); // Descrição detalhada da opção
            $table->integer('order')->default(0); // Ordem de exibição
            $table->boolean('has_other_field')->default(false); // Se ativa campo "Outro"
            $table->string('other_field_label')->nullable(); // Label do campo "Outro"
            $table->string('other_field_placeholder')->nullable(); // Placeholder do campo "Outro"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('question_options');
    }
};
