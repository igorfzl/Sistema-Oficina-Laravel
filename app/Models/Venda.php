<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = ['data_venda', 'valor_total', 'cliente_id', 'usuario_id'];
    use HasFactory;

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'venda_produto')->withPivot('quantidade', 'preco_unitario');
    }
}
