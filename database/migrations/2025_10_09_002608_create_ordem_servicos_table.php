<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ordem_servicos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('veiculo_id')->constrained('veiculos');

            $table->foreignId('produto_id')->nullable()->constrained('produtos');
            $table->integer('produto_quantidade')->nullable();
            $table->foreignId('servico_id')->nullable()->constrained('servicos');

            $table->string('status')->default('Pendente');
            $table->date('data_entrada');
            $table->date('data_saida_prevista')->nullable();
            $table->text('descricao_problema')->nullable();
            $table->text('observacoes')->nullable();
            $table->decimal('valor_total', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordem_servicos');
    }
};
