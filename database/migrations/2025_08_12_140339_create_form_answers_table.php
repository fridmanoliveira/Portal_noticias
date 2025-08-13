<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_submission_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_option_id')->nullable()->constrained('question_options')->onDelete('cascade');
            $table->text('answer_text')->nullable(); // Para respostas textuais
            $table->text('other_text')->nullable(); // Texto da opção "Outro"
            $table->timestamps();

            $table->index(['form_submission_id', 'question_id']); // Otimização para consultas
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_answers');
    }
};
