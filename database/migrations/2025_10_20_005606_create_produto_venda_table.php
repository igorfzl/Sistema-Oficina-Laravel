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
        // Este arquivo deve criar a tabela de LIGAÇÃO 'produto_venda'
        Schema::create('produto_venda', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('venda_id');
            $table->unsignedBigInteger('produto_id');

            $table->integer('quantidade');
            $table->decimal('preco_unitario', 10, 2);

            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_venda');
    }
};
