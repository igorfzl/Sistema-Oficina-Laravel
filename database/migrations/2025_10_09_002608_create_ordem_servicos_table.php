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
        Schema::create('ordem_servicos', function (Blueprint $table) {
            $table->id();

            // Chaves estrangeiras principais
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('veiculo_id');

            // Status da OS (Ex: 'Pendente', 'Em Andamento', 'Finalizada')
            $table->string('status')->default('Pendente');

            $table->date('data_entrada');
            $table->date('data_saida_prevista')->nullable();
            $table->text('descricao_problema')->nullable();
            $table->text('observacoes')->nullable();
            $table->decimal('valor_total', 10, 2)->default(0);

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('veiculo_id')->references('id')->on('veiculos');

            $table->timestamps(); // Apenas uma chamada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordem_servicos');
    }
};
