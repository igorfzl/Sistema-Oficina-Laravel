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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            // Uma venda pode opcionalmente pertencer a um cliente cadastrado.
            // Se o cliente não for informado, pode ser uma venda de balcão.
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->date('data_venda');
            $table->decimal('valor_total', 10, 2);
            $table->string('status')->default('Finalizada');
            $table->text('observacoes')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
