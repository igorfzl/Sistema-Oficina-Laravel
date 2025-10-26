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

            // Colunas da sua migração original
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->date('data_venda');
            $table->decimal('valor_total', 10, 2);
            $table->string('status')->default('Finalizada');
            $table->text('observacoes')->nullable();

            // --- COLUNAS EM FALTA (A CAUSA DO ERRO) ---
            $table->foreignId('produto_id')
                  ->constrained('produtos')
                  ->onDelete('cascade'); // Se um produto for apagado, apaga a venda associada

            $table->integer('quantidade');
            // --- FIM DAS COLUNAS EM FALTA ---

            // Definição da chave estrangeira (corrigida para 'onDelete('set null')')
            $table->foreign('cliente_id')
                  ->references('id')
                  ->on('clientes')
                  ->onDelete('set null'); // Se o cliente for apagado, define esta coluna como nula

            $table->timestamps();
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
