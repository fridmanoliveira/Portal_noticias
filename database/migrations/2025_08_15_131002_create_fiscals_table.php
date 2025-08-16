<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fiscais', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('crea')->nullable();
            $table->string('cpf', 14);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fiscais');
    }
};
