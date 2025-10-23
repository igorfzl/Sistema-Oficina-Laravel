<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'descricao', 'valor', 'categoria_produto_id'];

    public function categoriaProduto()
    {
        return $this->belongsTo(CategoriaProduto::class);
    }

    public function vendas()
    {
        return $this->belongsToMany(Venda::class, 'venda_produto')->withPivot('quantidade', 'preco_unitario');
    }
}
