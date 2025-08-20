<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->id();
            $table->string('descricao', 255);
            $table->string('fonte_recurso')->nullable();
            $table->date('data_inicio');
            $table->date('data_conclusao')->nullable();
            $table->string('situacao'); // Ex.: Em execução, Concluída...
            $table->string('etapa_atual')->nullable();
            $table->decimal('valor', 15, 2)->default(0);
            $table->decimal('valor_aditado', 15, 2)->nullable()->default(0);
            $table->integer('prazo_aditado')->nullable()->default(0);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->unsignedBigInteger('fiscal_id');
            $table->foreign('fiscal_id')->references('id')->on('fiscais')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obras');
    }
};
