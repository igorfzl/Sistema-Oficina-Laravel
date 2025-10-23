<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    protected $fillable = ['data_abertura', 'data_fechamento', 'status', 'veiculo_id', 'cliente_id', 'produto_id', 'descricao_servico', 'valor_total'];
    use HasFactory;

        public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    /**
     * Define o relacionamento de "Muitos para Muitos" com Produto.
     * Uma Ordem de Serviço pode ter MUITOS Produtos.
     */
    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'ordem_servico_produto')
                    ->withPivot('quantidade', 'preco_unitario')
                    ->withTimestamps();
    }

    /**
     * Define o relacionamento de "Muitos para Muitos" com Servico.
     * Uma Ordem de Serviço pode ter MUITOS Serviços.
     */
    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'ordem_servico_servico')
                    ->withPivot('valor_cobrado')
                    ->withTimestamps();
    }
}
