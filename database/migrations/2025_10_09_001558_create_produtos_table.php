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
        // Este arquivo deve criar a tabela 'produtos' (o catálogo de peças)
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->decimal('valor', 10, 2);

            // Um produto PERTENCE A UMA Categoria
            $table->unsignedBigInteger('categoria_produto_id')->nullable();
            $table->foreign('categoria_produto_id')
                ->references('id')
                ->on('categoria_produtos'); // Garante que 'categoria_produtos' execute antes

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
