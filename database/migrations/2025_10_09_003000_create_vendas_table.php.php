<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa as migrações.
     */
    public function up(): void
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->date('data_venda');
            $table->decimal('valor_total', 10, 2);
            $table->string('status')->default('Finalizada');
            $table->text('observacoes')->nullable();
            $table->foreignId('produto_id')
                ->constrained('produtos')
                ->onDelete('cascade'); // Se um produto for apagado, apaga a venda associada
            $table->integer('quantidade');
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('set null');
            $table->timestamps();
            $table->string('forma_pagamento', 50)->nullable();
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
